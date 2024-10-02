import cv2
import numpy as np
import face_recognition
import os
import mysql.connector
import random
#Storing  the arguments from triggered php file
img_path='Empty'
#path = 'E:/faces/'
path = 'C:/xampp/htdocs/DOT/faces'
images = []		# LIST CONTAINING ALL THE IMAGES
classNames = []		#LIST CONTAINING ALL THE CORRESPONDING CLASS Names
myList = os.listdir(path)
Session_Id = str(random.randint(5000, 500000))
#print(myList)
for cl in myList:
    curImg = cv2.imread(f'{path}/{cl}')
    images.append(curImg)
    classNames.append(os.path.splitext(cl)[0])
    
def finddata():
    mysql.connector.connect()
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="POLICE"
    )
    mycursor = mydb.cursor()
    sql = "SELECT * FROM MISSING_DETAILS"
    mycursor.execute(sql)
    # Fetch all the results as a list of tuples
    results = mycursor.fetchall()
    if len(results) != 1:
        print ("Error:Trouble connecting with phpMyAdmin")
    else:
    # Access the data from the first (and only) row
        data = results[0]
    # Extract the attributes from the data tuple
        arg1 = data[0]
        img_path = data[1]
        
    mydb.close()
    return(arg1,img_path)
#print(images)   
def findEncodings(images):
    encodeList = []
    for img in images:
        img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
        encode = face_recognition.face_encodings(img)[0]
        encodeList.append(encode)
    return encodeList

def addtab():
    mysql.connector.connect()
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="POLICE"
    )
    mycursor = mydb.cursor()
    
    
    sql = "INSERT INTO MATCHFOUND (Name,M_ID,img_path,Session) VALUES (%s,%s,%s,%s)"
    # The name for best match
    """data = [
            (arg1,name,img_path,Session_Id)
           ] 
    #print(data)
    # use a loop to add more rows to the data list
    #print(nearmatch)
    for i in nearmatch:
        data.append((arg1,i,img_path,Session_Id))
        print(i)"""
    # insert all the rows at once using the executemany() method
    mycursor.execute(sql, (arg1,name,img_path,Session_Id))
     
    mydb.commit()
    mycursor.close()
    mydb.close()
    return

def emptytable():
    mysql.connector.connect()
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="POLICE"
    )
    mycursor = mydb.cursor()
    
    sql = "DELETE FROM MISSING_DETAILS"
    mycursor.execute(sql)
    mydb.commit()
    mydb.close()
    return

arg1,img_path=finddata()
encodeListKnown = findEncodings(images)

#img = cv2.imread(img_path)
img = cv2.imread('C:/xampp/htdocs/DOT/'+img_path)
#imgS = cv2.resize(img,(0,0),None,0.25,0.25)
imgS = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
 
#For each frame
facesCurFrame = face_recognition.face_locations(imgS)
encodesCurFrame = face_recognition.face_encodings(imgS,facesCurFrame)

#Find Matches
for encodeFace,faceLoc in zip(encodesCurFrame,facesCurFrame):
    matches = face_recognition.compare_faces(encodeListKnown,encodeFace)
    faceDis = face_recognition.face_distance(encodeListKnown,encodeFace)
    #print(faceDis)
#find the minimum one, as this would be the best match.
    matchIndex = np.argmin(faceDis)
    nearmatch=[]
    name = classNames[matchIndex]
    name=name[:name.rfind("-")]
    for i in faceDis:
     
        if (i-faceDis[matchIndex])<0.1:
            a=np.where(faceDis==i)[0][0]
            a.astype(np.int64)
            if classNames[a][:classNames[a].rfind("-")]!=name and classNames[a][:classNames[a].rfind("-")] not in nearmatch:
                nearmatch.append(classNames[a][:classNames[a].rfind("-")])
#based on the index value determine the name and display it Image.
    if faceDis[matchIndex] < 0.5: #& matches[matchIndex]:
        #.upper()
        #print(faceDis)
        addtab()
        p_dist=round((1-faceDis[matchIndex])*100, 2)
    else:
        name="Unknown"
        #subprocess.call(["php", "E:/Xampp/htdocs/face/fau.php",0])
    emptytable()
    #output for the php which called the code
    if(name=="Unknown"):
        print("No suitable match found.")
    else:
        #op=str(Session_Id)+" Closest match with Name: "+str(arg1)+" with accuracy of "+str(p_dist)+"%."
        op=str(Session_Id)+" Closest match with Found id: "+name+" with accuracy of "+str(p_dist)+"%."
        print(op)#"Closest match:")#+name+" with accuracy of "+p_dist)