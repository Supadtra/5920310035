# -*- coding: utf-8 -*-
"""
Created on Sun Apr 12 10:45:42 2020

@author: OPEN NOW
"""

from flask import Flask, request, jsonify,render_template
from werkzeug import secure_filename
import csv
from hashlib import sha256
from time import time
import json
import os.path


class blockchain(object):
    def __init__(self,student_id):
        self.chain=[]
        self.student_id = student_id
        
    # sha256 hash
    def data_hash(self,data):
        return sha256(str(data).encode('utf8')).hexdigest()
    
    # last block 
    def _lastBlock(self):

        data = {
            'stid': None,
            'code': None,
            'grade': None,
            'time':None,
            'year':None,
            'seme':None,
            'creater':None,
        }

        header = {
            'index':len(self.chain)+1,
            'timestamp':time(),
            'prev_hash':self.data_hash(self.chain[-1]),
            'hashData': self.data_hash(data),
        }
        
        block = {'header':header,'data': data}     
        self.chain.append(block)
        
    # current block + last block create
    def generic_block(self):

        data = {
            'stid': self.student_id,
            'code': None,
            'grade': None,
            'time':time(),
            'year':None,
            'seme':None,
            'creater':None,
        }
                
        header = {
            'index':1,
            'timestamp':time(),
            'prev_hash':None,
            'hashData': self.data_hash(data),
        }

        block = {'header':header,'data': data}     
        self.chain.append(block)
        self._lastBlock()    
    
    def verify(self):
        currentB=self.chain[-1]  
        valid=True
        index = len(self.chain)-1
      
        while (index > 0 and valid == True):
            
                prev_B=self.chain[index-1]
              
                if(currentB['header']['prev_hash']==self.data_hash(prev_B)):
                    currentB = prev_B
                    valid = True
                    index -= 1
                
                else:
                    valid=False
                    index -= 1
                   
        return valid
  
    def load_data(self):
        
        filename = str(self.student_id + ".json")
        print (filename)
       
        if os.path.exists(filename) == True:
            
            # load json to self.chain
            with open(filename, "r") as f:
                reader = json.load(f)
                for row in reader:
                   self.chain.append(row)
                  
            return True
        else:
            print("Nots")
            return False
    
    def save_data(self):
        
        filename = str(self.student_id + ".json")
        
        try:
	        with open(filename,'w') as f:
	            json.dump(self.chain,f)
	        return True
		
        except IOError:
            return False

    def input_data(self,stdid,code,grade,year,seme,creator):
        
        #print(self.chain[-1]['header']['prev_hash'])

        tmpBlock = self.chain[-1]
        
        tmpBlock['data']['stid'] = stdid
        tmpBlock['data']['code'] = code
        tmpBlock['data']['grade'] = grade
        tmpBlock['data']['time'] = time()
        tmpBlock['data']['year'] = year
        tmpBlock['data']['seme'] = seme
        tmpBlock['data']['creater'] = creator
        
        tmpBlock['header']['index'] = len(self.chain)
        tmpBlock['header']['timestamp'] = time()
        tmpBlock['header']['hashData'] = self.data_hash(tmpBlock['data'])
    
        self._lastBlock()  
        
"""
start flask
"""
app = Flask(__name__)

"""
save grade 
"""	
@app.route('/add', methods=['POST'])
def adding():

    data = request.get_json()
   
    bc = blockchain(data["stdid"])

    # check existing 
    if bc.load_data() == True:
    	bc.input_data(data["stdid"],data["code"],data["grade"],data["year"],data["seme"],data["creator"])
    	if bc.save_data() == True:
    		res_code = 1
    	else:
    		res_code = 0
    else:
    	bc.generic_block()
    	bc.input_data(data["stdid"],data["code"],data["grade"],data["year"],data["seme"],data["creator"])
    	if bc.save_data() == True:
    		res_code = 1
    	else:
    		res_code = 0
    	
    response = {
    		
    		"res_code": res_code
            
            }
    return jsonify(response), 200
"""
Verify grade 
"""
@app.route('/cp', methods=['POST'])
def compareG():
    
    req_data = request.get_json()
    
    stid = req_data['stdid']
    grade = req_data['grade']
    code = req_data['code']
    year = req_data['year']
    seme = req_data['seme']
    print(stid,grade,code,year,seme)
    
    
    bc = blockchain(stid)

    
    if bc.load_data ()==True:
        response = {'res_code':"load data"}
        if bc.verify ()==True:
            response = {'res_code':"verify"}
            vf=True
            
            #เราไม่เอาบล็อกสุดท้าย index จะเริ่มที่ 1 ให้ตรงกับค่า len
            i=len(bc.chain)-1
            for block in bc.chain:
                block=bc.chain[i]
                i=i-1
                if vf==True:
                      if block['data']['stid']==stid:
                          if block['data']['code']==code:
                              if block['data']['year']==year:
                                  if block['data']['seme']==seme:
                                           if block['data']['grade']==grade:
                                               response = {'res_code':1,'valid':True}
                                               vf=False
                                               print (response)
                                               return jsonify(response)
                                           elif block['data']['grade']!=grade:
                                               response = {'res_code':0,'valid':"false"}
                                               vf=False
                                               print (response)
                                               return jsonify(response)
                                               break
                          if block['header']['index']==1:                                    
                                response = {'res_code':101,'valid':"Don't have data"}
                                print (response)
                                return jsonify(response) 
                                    
        elif bc.verify ()!=True:                                   
                    response = {'res_code':102,'valid':"Data in blockchain Not good!"}
                    print (response)
                    return jsonify(response)      
    
    elif bc.load_data ()!=True:                                   
                    response = {'res_code':101,'valid':"Don't have data"}
                    print (response)
                    return jsonify(response)       
"""
show grade 
"""
@app.route('/<uid>', methods=['GET'])
def show(uid):
    bc =  blockchain(uid)
    bc.load_data()
    
    response = {
            'chain': bc.chain
        }

    return jsonify(response), 200 

if __name__ == '__main__':
   app.run(host='0.0.0.0', port=2000)