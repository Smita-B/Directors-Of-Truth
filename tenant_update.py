import cv2
import numpy as np
import face_recognition
import os
import mysql.connector
#Storing  the arguments from triggered php file
img_path='Empty'
#path = 'E:/faces/'
path = 'C:/xampp/htdocs/DOT/cfaces'
#path = 'C:/xampp/htdocs/TPOLICE/Missing_images'
images = []		# LIST CONTAINING ALL THE IMAGES
classNames = []		#LIST CONTAINING ALL THE CORRESPONDING CLASS Names
myList = os.listdir(path)
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
    sql1 = "SELECT PHOTO \
            FROM ID_VERIFICATION WHERE VERIFY_RESULT = %s"
    mycursor.execute(sql1, ('Unchecked',))
    
    # Fetch the result
    result = mycursor.fetchone()
    if result is None:
        print("Error: Trouble connecting with ID_VERIFICATION table.")
        return 0

    # Access the data from the result tuple
    img_path = result[0]
    #print(img_path)
    mycursor.close()
    mydb.close()    
    return(img_path)

def updatedata(vresult,pd):
    mysql.connector.connect()
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="POLICE"
    )
    mycursor = mydb.cursor()
    sql1 = "UPDATE ID_VERIFICATION SET PMATCH = %s WHERE VERIFY_RESULT = %s"
    mycursor.execute(sql1, (pd, 'Unchecked',))
    
    mydb.commit()
    sql2 = "UPDATE ID_VERIFICATION SET VERIFY_RESULT = %s WHERE VERIFY_RESULT = %s"
    mycursor.execute(sql2, (vresult, 'Unchecked',))

    mydb.commit()
    mycursor.close()
    mydb.close()     
    return

def findEncodings(images):
    encodeList = []
    for img in images:
        img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
        encode = face_recognition.face_encodings(img)[0]
        encodeList.append(encode)
    return encodeList

img_path=finddata()
encodeListKnown = findEncodings(images)

#img = cv2.imread(img_path)
img = cv2.imread('C:/xampp/htdocs/DOT/'+img_path)
#img = cv2.imread('C:/xampp/htdocs/TPOLICE/'+img_path)

#imgS = cv2.resize(img,(0,0),None,0.25,0.25)
imgS = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
 
#For each frame
facesCurFrame = face_recognition.face_locations(imgS)
encodesCurFrame = face_recognition.face_encodings(imgS,facesCurFrame)
result="NoMatch"
p_dist=0.00
#Find Matches
for encodeFace,faceLoc in zip(encodesCurFrame,facesCurFrame):
    matches = face_recognition.compare_faces(encodeListKnown,encodeFace)
    faceDis = face_recognition.face_distance(encodeListKnown,encodeFace)
    #find the minimum one, as this would be the best match.
    matchIndex = np.argmin(faceDis)
    nearmatch=[]
    name = classNames[matchIndex]
    name=name[:name.rfind("-")]
    #based on the index value determine the name and display it Image.
    if faceDis[matchIndex] < 0.5: #& matches[matchIndex]:
        #.upper()
        result="Matched"
        p_dist=round((1-faceDis[matchIndex])*100, 2)

print(result,p_dist)
updatedata(result,p_dist)
