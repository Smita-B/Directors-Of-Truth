import skfuzzy as fuzz
from skfuzzy import control as ctrl
import numpy as np
import matplotlib.pyplot as plt
import mysql.connector

def clean_fuzz():
    mysql.connector.connect()
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="POLICE"
    )
    mycursor = mydb.cursor()
    sql1="UPDATE Fuzzy SET pdanger = 0"
    mycursor.execute(sql1)
    mydb.commit()
    sql2="UPDATE Fuzzy SET crime = 0"
    mycursor.execute(sql2)
    mydb.commit()
    sql3="UPDATE Fuzzy SET report = 0"
    mycursor.execute(sql3)
    mydb.commit()
    sql4="UPDATE Fuzzy SET missing =0"
    mycursor.execute(sql4)
    mydb.commit()
    mycursor.close()
    mydb.close()
    return()
    
def assignps(P_id):
    mysql.connector.connect()
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="POLICE"
    )
    mycursor = mydb.cursor()
    sql1 = "SELECT PSNAME FROM POLICE_RECORD WHERE P_id = %s"
    mycursor.execute(sql1, (P_id,))
    
    # Fetch the result
    result = mycursor.fetchone()
    if result is None:
        print("Error: Trouble connecting with POLICE_RECORD table.")
        return None
    
    # Access the data from the result tuple
    pname = result[0]
    
    mycursor.close()
    mydb.close()
    return(pname) 
 
def calc_pdanger(psname):
    pdanger=0
    mysql.connector.connect()
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="POLICE"
    )
    mycursor = mydb.cursor()
    sql1 = "SELECT AVG(Rating) FROM PERCIEVED_DANGER WHERE PSNAME=%s"
    mycursor.execute(sql1, (psname,))
    # Fetch all the results as a list of tuples
    
    result = mycursor.fetchone()
    if result is None:
        print("Error: Trouble connecting with CRIMINAL_RECORD table.")
        return 0
    # Access the data from the first (and only) row
    pdanger = result[0]
    # Extract the attributes from the data tuple
    sql2="UPDATE Fuzzy SET pdanger =%s WHERE PSNAME = %s"
    mycursor.execute(sql2, (pdanger, psname,))
    mydb.commit()
    mycursor.close()
    mydb.close()
    pdanger=int(0 if pdanger is None else pdanger)
    return(pdanger)
    
def calc_miss(psname):
    mcrime=0
    mysql.connector.connect()
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="POLICE"
    )    
    mycursor = mydb.cursor()
    sql1 = "SELECT AVG(C)\
        FROM( SELECT  COUNT(REG_ID) as C FROM MISSING_REPORT WHERE PSNAME=%s\
        GROUP BY(DATE)) as Aa"
    mycursor.execute(sql1, (psname,))
    # Fetch all the results as a list of tuples
    result = mycursor.fetchone()
    mcrime = result[0]
    if result is None:
        print("Error: Trouble connecting with CRIMINAL_RECORD table.")
        mcrime = 0
    # Access the data from the first (and only) row
   
    sql2="UPDATE Fuzzy SET missing = %s  WHERE PSNAME = %s"
    mycursor.execute(sql2, (mcrime, psname,))
    mydb.commit()
    mycursor.close()
    mydb.close()
    
    mcrime=int(0 if mcrime is None else mcrime)
    return(mcrime)
     ##################################################################################CYBER CRIME
def calc_report(psname):
    rcrime=0
    mysql.connector.connect()
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="POLICE"
    )    
    mycursor = mydb.cursor()
    sql1 = "SELECT AVG(C)\
        FROM (SELECT SUM(CRIME_WEIGHT) AS C\
              FROM FIR_DETAILS\
              WHERE PSNAME = %s\
              GROUP BY Date) AS Ab;"
    mycursor.execute(sql1, (psname,))
    # Fetch all the results as a list of tuples
    result = mycursor.fetchone()
    if result is None:
        print("Error: Trouble connecting with CRIMINAL_RECORD table.")
        return 0
    # Access the data from the first (and only) row
    rcrime = result[0]
    # Extract the attributes from the data tuple
    sql2="UPDATE Fuzzy SET report = %s WHERE PSNAME = %s"
    mycursor.execute(sql2, (rcrime, psname,))
    mydb.commit()
    mycursor.close()
    mydb.close()
    
    rcrime=int(0 if rcrime is None else rcrime)
    return(rcrime)

def calc_crime(psname):
    ccrime=0
    mysql.connector.connect()
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="POLICE"
    )    
    mycursor = mydb.cursor()
    sql1 = "SELECT AVG(C) \
            FROM (SELECT SUM(PUNISHMENT_TYPE) AS C FROM CRIMINAL_RECORD WHERE PSNAME = %s) AS Ac"
    mycursor.execute(sql1, (psname,))
    
    # Fetch the result
    result = mycursor.fetchone()
    if result is None:
        print("Error: Trouble connecting with CRIMINAL_RECORD table.")
        return 0
    
    # Access the data from the result tuple
    ccrime = result[0]
    if ccrime is None:
        ccrime=0
    sql2 = "UPDATE Fuzzy SET crime = %s WHERE PSNAME = %s"
    mycursor.execute(sql2, (ccrime, psname,))
    
    mydb.commit()
    mycursor.close()
    mydb.close()
    
    ccrime=int(0 if ccrime is None else ccrime)
    return(ccrime)    
    
def calc_danger(psname,danger,max_set,cc,cr,cm,cpd):
    mysql.connector.connect()
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="POLICE"
    )    
    mycursor = mydb.cursor()
    sql1="UPDATE Fuzzy SET danger = %s WHERE PSNAME = %s"
    mycursor.execute(sql1, (danger, psname,))
    mydb.commit()
    sql2="UPDATE Fuzzy SET ccrime =%s  WHERE PSNAME = %s"
    mycursor.execute(sql2, (cc, psname,))
    mydb.commit()
    sql2="UPDATE Fuzzy SET creport =%s  WHERE PSNAME = %s"
    mycursor.execute(sql2, (cr, psname,))
    mydb.commit()
    sql2="UPDATE Fuzzy SET cmissing =%s  WHERE PSNAME = %s"
    mycursor.execute(sql2, (cm, psname,))
    mydb.commit()
    sql2="UPDATE Fuzzy SET cpdanger =%s  WHERE PSNAME = %s"
    mycursor.execute(sql2, (cpd, psname,))
    mydb.commit()
    sql2="UPDATE Fuzzy SET comment =%s  WHERE PSNAME = %s"
    mycursor.execute(sql2, (max_set, psname,))
    mydb.commit()
    mydb.close()
    return()

# Generate universe variables
x_pdanger = np.arange(0, 11, 1)
x_missing = np.arange(0, 21, 1)
x_crime = np.arange(0, 31, 1)
x_report = np.arange(0, 21, 1)
x_danger = np.arange(0, 101, 1)

# Generate fuzzy membership functions
pdanger_lo = fuzz.trapmf(x_pdanger, [0,0, 2,4])
pdanger_md = fuzz.trapmf(x_pdanger, [3, 4, 6, 7])
pdanger_hi = fuzz.trapmf(x_pdanger, [6,8,10,10])

missing_lo = fuzz.trapmf(x_missing, [0,0, 3, 5])
missing_md = fuzz.trapmf(x_missing, [4, 5, 7, 8])
missing_hi = fuzz.trapmf(x_missing, [7, 10, 20, 20])

crime_lo = fuzz.trapmf(x_crime, [0, 0, 3,5])
crime_md = fuzz.trapmf(x_crime, [3, 5, 6, 7])
crime_hi = fuzz.trapmf(x_crime, [5, 10, 30, 30])

report_lo = fuzz.trapmf(x_report, [0, 0, 3,5])
report_md = fuzz.trapmf(x_report, [4, 5, 7, 8])
report_hi = fuzz.trapmf(x_report, [7, 10, 20, 20])

danger_vlo = fuzz.trapmf(x_danger, [0, 0, 10, 30])
danger_lo = fuzz.trapmf(x_danger, [10, 30, 40, 60])
danger_md = fuzz.trapmf(x_danger, [40, 60, 70, 90])
danger_hi = fuzz.trapmf(x_danger, [70, 90, 100, 100])
danger_vhi = fuzz.trapmf(x_danger, [90, 100, 100, 100])


# Get input from the user
clean_fuzz()
P_id=202001;
for i in range(81):
    psname=assignps(P_id)
    crime_value = int(calc_crime(psname))
    report_value = calc_report(psname)
    missing_value = calc_miss(psname)
    pdanger_value =int( calc_pdanger(psname))
    print(psname,crime_value,report_value,missing_value,pdanger_value)
    """pdanger = float(input("Enter the pdanger score (0-20): "))
    missing = float(input("Enter the missing score (0-20): "))
    crime = float(input("Enter the crime score (0-20): "))
    report = float(input("Enter the report score (0-20): "))"""
    
    crime = crime_value
    report = report_value
    missing = missing_value
    pdanger = pdanger_value
    
    
    
    # Define weights for each input variable"""
    weight_pdanger = 1
    weight_missing = 1
    weight_crime =1
    weight_report = 1
    
    
    # Calculate membership values for input variables
    pdanger_level_lo = fuzz.interp_membership(x_pdanger, pdanger_lo, pdanger) * weight_pdanger
    pdanger_level_md = fuzz.interp_membership(x_pdanger, pdanger_md, pdanger) * weight_pdanger
    pdanger_level_hi = fuzz.interp_membership(x_pdanger, pdanger_hi, pdanger) * weight_pdanger
    
    missing_level_lo = fuzz.interp_membership(x_missing, missing_lo, missing) * weight_missing
    missing_level_md = fuzz.interp_membership(x_missing, missing_md, missing) * weight_missing
    missing_level_hi = fuzz.interp_membership(x_missing, missing_hi, missing) * weight_missing
    
    crime_level_lo = fuzz.interp_membership(x_crime, crime_lo, crime) * weight_crime
    crime_level_md = fuzz.interp_membership(x_crime, crime_md, crime) * weight_crime
    crime_level_hi = fuzz.interp_membership(x_crime, crime_hi, crime) * weight_crime
    
    report_level_lo = fuzz.interp_membership(x_report, report_lo, report) * weight_report
    report_level_md = fuzz.interp_membership(x_report, report_md, report) * weight_report
    report_level_hi = fuzz.interp_membership(x_report, report_hi, report) * weight_report
    
    
    
    
    
    
    
    
    
    # Find the set with the highest membership value for each variable
    max_pdanger = max(pdanger_level_lo, pdanger_level_md, pdanger_level_hi)
    max_missing = max(missing_level_lo, missing_level_md, missing_level_hi)
    max_crime = max(crime_level_lo, crime_level_md, crime_level_hi)
    max_report = max(report_level_lo, report_level_md, report_level_hi)
    
    # Print the fuzzy sets with the highest membership values
    
    if max_pdanger == pdanger_level_lo:
        cpd="Low"
    elif max_pdanger == pdanger_level_md:
        cpd="Medium"
    else:
        cpd="High"
    
    if max_missing == missing_level_lo:
        cm="Low"
    elif max_missing == missing_level_md:
        cm="Medium"
    else:
        cm="High"
    
    if max_crime == crime_level_lo:
        cc="Low"
    elif max_crime == crime_level_md:
        cc="Medium"
    else:
        cc="High"
    
    if max_report == report_level_lo:
        cr="Low"
    elif max_report == report_level_md:
        cr="Medium"
    else:
        cr="High"
    
    
    
    
    
    # Apply fuzzy rules
    # Rule 1
    rule1 = np.fmin(np.fmin(crime_level_lo, report_level_lo), np.fmin(missing_level_lo, pdanger_level_lo))
    danger_activation_vlo1 = np.fmin(rule1, danger_vlo)
    
    # Rule 2
    rule2 = np.fmin(np.fmin(crime_level_lo, report_level_lo), np.fmin(missing_level_lo, pdanger_level_md))
    danger_activation_vlo2 = np.fmin(rule2, danger_vlo)
    
    # Rule 3
    rule3 = np.fmin(np.fmin(crime_level_lo, report_level_lo), np.fmin(missing_level_lo, pdanger_level_hi))
    danger_activation_vlo3 = np.fmin(rule3, danger_vlo)
    
    # Rule 4
    rule4 = np.fmin(np.fmin(crime_level_lo, report_level_lo), np.fmin(missing_level_md, pdanger_level_lo))
    danger_activation_vlo4 = np.fmin(rule4, danger_vlo)
    
    # Rule 5
    rule5 = np.fmin(np.fmin(crime_level_lo, report_level_lo), np.fmin(missing_level_md, pdanger_level_md))
    danger_activation_vlo5 = np.fmin(rule5, danger_vlo)
    
    # Rule 6
    rule6 = np.fmin(np.fmin(crime_level_lo, report_level_lo), np.fmin(missing_level_md, pdanger_level_hi))
    danger_activation_vlo6 = np.fmin(rule6, danger_vlo)
    
    # Rule 7
    rule7 = np.fmin(np.fmin(crime_level_lo, report_level_lo), np.fmin(missing_level_hi, pdanger_level_lo))
    danger_activation_vlo7 = np.fmin(rule7, danger_vlo)
    
    # Rule 8
    rule8 = np.fmin(np.fmin(crime_level_lo, report_level_lo), np.fmin(missing_level_hi, pdanger_level_md))
    danger_activation_vlo8 = np.fmin(rule8, danger_vlo)
    
    # Rule 9
    rule9 = np.fmin(np.fmin(crime_level_lo, report_level_lo), np.fmin(missing_level_hi, pdanger_level_hi))
    danger_activation_vlo9 = np.fmin(rule9, danger_vlo)
    
    # Rule 10
    rule10 = np.fmin(np.fmin(crime_level_lo, report_level_md), np.fmin(missing_level_lo, pdanger_level_lo))
    danger_activation_lo10 = np.fmin(rule10, danger_lo)
    
    # Rule 11
    rule11 = np.fmin(np.fmin(crime_level_lo, report_level_md), np.fmin(missing_level_lo, pdanger_level_md))
    danger_activation_lo11 = np.fmin(rule11, danger_lo)
    
    # Rule 12
    rule12 = np.fmin(np.fmin(crime_level_lo, report_level_md), np.fmin(missing_level_lo, pdanger_level_hi))
    danger_activation_lo12 = np.fmin(rule12, danger_lo)
    
    # Rule 13
    rule13 = np.fmin(np.fmin(crime_level_lo, report_level_md), np.fmin(missing_level_md, pdanger_level_lo))
    danger_activation_lo13 = np.fmin(rule13, danger_lo)
    
    # Rule 14
    rule14 = np.fmin(np.fmin(crime_level_lo, report_level_md), np.fmin(missing_level_md, pdanger_level_md))
    danger_activation_lo14 = np.fmin(rule14, danger_lo)
    
    # Rule 15
    rule15 = np.fmin(np.fmin(crime_level_lo, report_level_md), np.fmin(missing_level_md, pdanger_level_hi))
    danger_activation_lo15 = np.fmin(rule15, danger_lo)
    
    # Rule 16
    rule16 = np.fmin(np.fmin(crime_level_lo, report_level_md), np.fmin(missing_level_hi, pdanger_level_lo))
    danger_activation_lo16 = np.fmin(rule16, danger_lo)
    
    # Rule 17
    rule17 = np.fmin(np.fmin(crime_level_lo, report_level_md), np.fmin(missing_level_hi, pdanger_level_md))
    danger_activation_lo17 = np.fmin(rule17, danger_lo)
    
    # Rule 18
    rule18 = np.fmin(np.fmin(crime_level_lo, report_level_md), np.fmin(missing_level_hi, pdanger_level_hi))
    danger_activation_lo18 = np.fmin(rule18, danger_lo)
    
    # Rule 19
    rule19 = np.fmin(np.fmin(crime_level_lo, report_level_hi), np.fmin(missing_level_lo, pdanger_level_lo))
    danger_activation_lo19 = np.fmin(rule19, danger_lo)
    
    # Rule 20
    rule20 = np.fmin(np.fmin(crime_level_lo, report_level_hi), np.fmin(missing_level_lo, pdanger_level_md))
    danger_activation_lo20 = np.fmin(rule20, danger_lo)
    
    # Rule 21
    rule21 = np.fmin(np.fmin(crime_level_lo, report_level_hi), np.fmin(missing_level_lo, pdanger_level_hi))
    danger_activation_lo21 = np.fmin(rule21, danger_lo)
    
    # Rule 22
    rule22 = np.fmin(np.fmin(crime_level_lo, report_level_hi), np.fmin(missing_level_md, pdanger_level_lo))
    danger_activation_lo22 = np.fmin(rule22, danger_lo)
    
    # Rule 23
    rule23 = np.fmin(np.fmin(crime_level_lo, report_level_hi), np.fmin(missing_level_md, pdanger_level_md))
    danger_activation_lo23 = np.fmin(rule23, danger_lo)
    
    # Rule 24
    rule24 = np.fmin(np.fmin(crime_level_lo, report_level_hi), np.fmin(missing_level_md, pdanger_level_hi))
    danger_activation_lo24 = np.fmin(rule24, danger_lo)
    
    # Rule 25
    rule25 = np.fmin(np.fmin(crime_level_lo, report_level_hi), np.fmin(missing_level_hi, pdanger_level_lo))
    danger_activation_lo25 = np.fmin(rule25, danger_lo)
    
    # Rule 26
    rule26 = np.fmin(np.fmin(crime_level_lo, report_level_hi), np.fmin(missing_level_hi, pdanger_level_md))
    danger_activation_lo26 = np.fmin(rule26, danger_lo)
    
    # Rule 27
    rule27 = np.fmin(np.fmin(crime_level_lo, report_level_hi), np.fmin(missing_level_hi, pdanger_level_hi))
    danger_activation_lo27 = np.fmin(rule27, danger_lo)
    
    # Rule 28
    rule28 = np.fmin(np.fmin(crime_level_md, report_level_lo), np.fmin(missing_level_lo, pdanger_level_lo))
    danger_activation_lo28 = np.fmin(rule28, danger_lo)
    
    # Rule 29
    rule29 = np.fmin(np.fmin(crime_level_md, report_level_lo), np.fmin(missing_level_lo, pdanger_level_md))
    danger_activation_lo29 = np.fmin(rule29, danger_lo)
    
    # Rule 30
    rule30 = np.fmin(np.fmin(crime_level_md, report_level_lo), np.fmin(missing_level_lo, pdanger_level_hi))
    danger_activation_lo30 = np.fmin(rule30, danger_lo)
    
    # Rule 31
    rule31 = np.fmin(np.fmin(crime_level_md, report_level_lo), np.fmin(missing_level_md, pdanger_level_lo))
    danger_activation_lo31 = np.fmin(rule31, danger_lo)
    
    # Rule 32
    rule32 = np.fmin(np.fmin(crime_level_md, report_level_lo), np.fmin(missing_level_md, pdanger_level_md))
    danger_activation_lo32 = np.fmin(rule32, danger_lo)
    
    # Rule 33
    rule33 = np.fmin(np.fmin(crime_level_md, report_level_lo), np.fmin(missing_level_md, pdanger_level_hi))
    danger_activation_lo33 = np.fmin(rule33, danger_lo)
    
    # Rule 34
    rule34 = np.fmin(np.fmin(crime_level_md, report_level_lo), np.fmin(missing_level_hi, pdanger_level_lo))
    danger_activation_lo34 = np.fmin(rule34, danger_lo)
    
    # Rule 35
    rule35 = np.fmin(np.fmin(crime_level_md, report_level_lo), np.fmin(missing_level_hi, pdanger_level_md))
    danger_activation_lo35 = np.fmin(rule35, danger_lo)
    
    # Rule 36
    rule36 = np.fmin(np.fmin(crime_level_md, report_level_lo), np.fmin(missing_level_hi, pdanger_level_hi))
    danger_activation_lo36 = np.fmin(rule36, danger_lo)
    
    # Rule 37
    rule37 = np.fmin(np.fmin(crime_level_md, report_level_md), np.fmin(missing_level_lo, pdanger_level_lo))
    danger_activation_lo37 = np.fmin(rule37, danger_lo)
    
    # Rule 38
    rule38 = np.fmin(np.fmin(crime_level_md, report_level_md), np.fmin(missing_level_lo, pdanger_level_md))
    danger_activation_lo38 = np.fmin(rule38, danger_lo)
    
    # Rule 39
    rule39 = np.fmin(np.fmin(crime_level_md, report_level_md), np.fmin(missing_level_lo, pdanger_level_hi))
    danger_activation_lo39 = np.fmin(rule39, danger_lo)
    
    # Rule 40
    rule40 = np.fmin(np.fmin(crime_level_md, report_level_md), np.fmin(missing_level_md, pdanger_level_lo))
    danger_activation_lo40 = np.fmin(rule40, danger_lo)
    
    # Rule 41
    rule41 = np.fmin(np.fmin(crime_level_md, report_level_md), np.fmin(missing_level_md, pdanger_level_md))
    danger_activation_lo41 = np.fmin(rule41, danger_lo)
    
    # Rule 42
    rule42 = np.fmin(np.fmin(crime_level_md, report_level_md), np.fmin(missing_level_md, pdanger_level_hi))
    danger_activation_lo42 = np.fmin(rule42, danger_lo)
    
    # Rule 43
    rule43 = np.fmin(np.fmin(crime_level_md, report_level_md), np.fmin(missing_level_hi, pdanger_level_lo))
    danger_activation_lo43 = np.fmin(rule43, danger_lo)
    
    # Rule 44
    rule44 = np.fmin(np.fmin(crime_level_md, report_level_md), np.fmin(missing_level_hi, pdanger_level_md))
    danger_activation_lo44 = np.fmin(rule44, danger_lo)
    
    # Rule 45
    rule45 = np.fmin(np.fmin(crime_level_md, report_level_md), np.fmin(missing_level_hi, pdanger_level_hi))
    danger_activation_lo45 = np.fmin(rule45, danger_lo)
    
    # Rule 46
    rule46 = np.fmin(np.fmin(crime_level_md, report_level_hi), np.fmin(missing_level_lo, pdanger_level_lo))
    danger_activation_md46 = np.fmin(rule46, danger_md)
    
    # Rule 47
    rule47 = np.fmin(np.fmin(crime_level_md, report_level_hi), np.fmin(missing_level_lo, pdanger_level_md))
    danger_activation_md47 = np.fmin(rule47, danger_md)
    
    # Rule 48
    rule48 = np.fmin(np.fmin(crime_level_md, report_level_hi), np.fmin(missing_level_lo, pdanger_level_hi))
    danger_activation_md48 = np.fmin(rule48, danger_md)
    
    # Rule 49
    rule49 = np.fmin(np.fmin(crime_level_md, report_level_hi), np.fmin(missing_level_md, pdanger_level_lo))
    danger_activation_md49 = np.fmin(rule49, danger_md)
    
    # Rule 50
    rule50 = np.fmin(np.fmin(crime_level_md, report_level_hi), np.fmin(missing_level_md, pdanger_level_md))
    danger_activation_md50 = np.fmin(rule50, danger_md)
    
    # Rule 51
    rule51 = np.fmin(np.fmin(crime_level_md, report_level_hi), np.fmin(missing_level_md, pdanger_level_hi))
    danger_activation_md51 = np.fmin(rule51, danger_md)
    
    # Rule 52
    rule52 = np.fmin(np.fmin(crime_level_md, report_level_hi), np.fmin(missing_level_hi, pdanger_level_lo))
    danger_activation_md52 = np.fmin(rule52, danger_md)
    
    # Rule 53
    rule53 = np.fmin(np.fmin(crime_level_md, report_level_hi), np.fmin(missing_level_hi, pdanger_level_md))
    danger_activation_md53 = np.fmin(rule53, danger_md)
    
    # Rule 54
    rule54 = np.fmin(np.fmin(crime_level_md, report_level_hi), np.fmin(missing_level_hi, pdanger_level_hi))
    danger_activation_md54 = np.fmin(rule54, danger_md)
    
    # Rule 55
    rule55 = np.fmin(np.fmin(crime_level_hi, report_level_lo), np.fmin(missing_level_lo, pdanger_level_lo))
    danger_activation_md55 = np.fmin(rule55, danger_md)
    
    # Rule 56
    rule56 = np.fmin(np.fmin(crime_level_hi, report_level_lo), np.fmin(missing_level_lo, pdanger_level_md))
    danger_activation_md56 = np.fmin(rule56, danger_md)
    
    # Rule 57
    rule57 = np.fmin(np.fmin(crime_level_hi, report_level_lo), np.fmin(missing_level_lo, pdanger_level_hi))
    danger_activation_md57 = np.fmin(rule57, danger_md)
    
    # Rule 58
    rule58 = np.fmin(np.fmin(crime_level_hi, report_level_lo), np.fmin(missing_level_md, pdanger_level_lo))
    danger_activation_md58 = np.fmin(rule58, danger_md)
    
    # Rule 59
    rule59 = np.fmin(np.fmin(crime_level_hi, report_level_lo), np.fmin(missing_level_md, pdanger_level_md))
    danger_activation_md59 = np.fmin(rule59, danger_md)
    
    # Rule 60
    rule60 = np.fmin(np.fmin(crime_level_hi, report_level_lo), np.fmin(missing_level_md, pdanger_level_hi))
    danger_activation_md60 = np.fmin(rule60, danger_md)
    
    # Rule 61
    rule61 = np.fmin(np.fmin(crime_level_hi, report_level_lo), np.fmin(missing_level_hi, pdanger_level_lo))
    danger_activation_md61 = np.fmin(rule61, danger_md)
    
    # Rule 62
    rule62 = np.fmin(np.fmin(crime_level_hi, report_level_lo), np.fmin(missing_level_hi, pdanger_level_md))
    danger_activation_md62 = np.fmin(rule62, danger_md)
    
    # Rule 63
    rule63 = np.fmin(np.fmin(crime_level_hi, report_level_lo), np.fmin(missing_level_hi, pdanger_level_hi))
    danger_activation_md63 = np.fmin(rule63, danger_md)
    
    # Rule 64
    rule64 = np.fmin(np.fmin(crime_level_hi, report_level_md), np.fmin(missing_level_lo, pdanger_level_lo))
    danger_activation_hi64 = np.fmin(rule64, danger_hi)
    
    # Rule 65
    rule65 = np.fmin(np.fmin(crime_level_hi, report_level_md), np.fmin(missing_level_lo, pdanger_level_md))
    danger_activation_hi65 = np.fmin(rule65, danger_hi)
    
    # Rule 66
    rule66 = np.fmin(np.fmin(crime_level_hi, report_level_md), np.fmin(missing_level_lo, pdanger_level_hi))
    danger_activation_hi66 = np.fmin(rule66, danger_hi)
    
    # Rule 67
    rule67 = np.fmin(np.fmin(crime_level_hi, report_level_md), np.fmin(missing_level_md, pdanger_level_lo))
    danger_activation_hi67 = np.fmin(rule67, danger_hi)
    
    # Rule 68
    rule68 = np.fmin(np.fmin(crime_level_hi, report_level_md), np.fmin(missing_level_md, pdanger_level_md))
    danger_activation_hi68 = np.fmin(rule68, danger_hi)
    
    # Rule 69
    rule69 = np.fmin(np.fmin(crime_level_hi, report_level_md), np.fmin(missing_level_md, pdanger_level_hi))
    danger_activation_hi69 = np.fmin(rule69, danger_hi)
    
    # Rule 70
    rule70 = np.fmin(np.fmin(crime_level_hi, report_level_md), np.fmin(missing_level_hi, pdanger_level_lo))
    danger_activation_hi70 = np.fmin(rule70, danger_hi)
    
    # Rule 71
    rule71 = np.fmin(np.fmin(crime_level_hi, report_level_md), np.fmin(missing_level_hi, pdanger_level_md))
    danger_activation_hi71 = np.fmin(rule71, danger_hi)
    
    # Rule 72
    rule72 = np.fmin(np.fmin(crime_level_hi, report_level_md), np.fmin(missing_level_hi, pdanger_level_hi))
    danger_activation_hi72 = np.fmin(rule72, danger_hi)
    
    # Rule 73
    rule73 = np.fmin(np.fmin(crime_level_hi, report_level_hi), np.fmin(missing_level_lo, pdanger_level_lo))
    danger_activation_vhi73 = np.fmin(rule73, danger_vhi)
    
    # Rule 74
    rule74 = np.fmin(np.fmin(crime_level_hi, report_level_hi), np.fmin(missing_level_lo, pdanger_level_md))
    danger_activation_vhi74 = np.fmin(rule74, danger_vhi)
    
    # Rule 75
    rule75 = np.fmin(np.fmin(crime_level_hi, report_level_hi), np.fmin(missing_level_lo, pdanger_level_hi))
    danger_activation_vhi75 = np.fmin(rule75, danger_vhi)
    
    # Rule 76
    rule76 = np.fmin(np.fmin(crime_level_hi, report_level_hi), np.fmin(missing_level_md, pdanger_level_lo))
    danger_activation_vhi76 = np.fmin(rule76, danger_vhi)
    
    # Rule 77
    rule77 = np.fmin(np.fmin(crime_level_hi, report_level_hi), np.fmin(missing_level_md, pdanger_level_md))
    danger_activation_vhi77 = np.fmin(rule77, danger_vhi)
    
    # Rule 78
    rule78 = np.fmin(np.fmin(crime_level_hi, report_level_hi), np.fmin(missing_level_md, pdanger_level_hi))
    danger_activation_vhi78 = np.fmin(rule78, danger_vhi)
    
    # Rule 79
    rule79 = np.fmin(np.fmin(crime_level_hi, report_level_hi), np.fmin(missing_level_hi, pdanger_level_lo))
    danger_activation_vhi79 = np.fmin(rule79, danger_vhi)
    
    # Rule 80
    rule80 = np.fmin(np.fmin(crime_level_hi, report_level_hi), np.fmin(missing_level_hi, pdanger_level_md))
    danger_activation_vhi80 = np.fmin(rule80, danger_vhi)
    
    # Rule 81
    rule81 = np.fmin(np.fmin(crime_level_hi, report_level_hi), np.fmin(missing_level_hi, pdanger_level_hi))
    danger_activation_vhi81 = np.fmin(rule81, danger_vhi)
    
    # Aggregate all output membership functions
    aggregated = np.fmax(danger_activation_vlo1, np.fmax(danger_activation_vlo2, np.fmax(danger_activation_vlo3, np.fmax(danger_activation_vlo4,
                        np.fmax(danger_activation_vlo5, np.fmax(danger_activation_vlo6, np.fmax(danger_activation_vlo7,
                        np.fmax(danger_activation_vlo8, np.fmax(danger_activation_vlo9, np.fmax(danger_activation_lo10,
                        np.fmax(danger_activation_lo11, np.fmax(danger_activation_lo12, np.fmax(danger_activation_lo13,
                        np.fmax(danger_activation_lo14, np.fmax(danger_activation_lo15, np.fmax(danger_activation_lo16,
                        np.fmax(danger_activation_lo17, np.fmax(danger_activation_lo18, np.fmax(danger_activation_lo19,
                        np.fmax(danger_activation_lo20, np.fmax(danger_activation_lo21, np.fmax(danger_activation_lo22,
                        np.fmax(danger_activation_lo23, np.fmax(danger_activation_lo24, np.fmax(danger_activation_lo25,
                        np.fmax(danger_activation_lo26, np.fmax(danger_activation_lo27, np.fmax(danger_activation_lo28,
                        np.fmax(danger_activation_lo29, np.fmax(danger_activation_lo30, np.fmax(danger_activation_lo31,
                        np.fmax(danger_activation_lo32, np.fmax(danger_activation_lo33, np.fmax(danger_activation_lo34,
                        np.fmax(danger_activation_lo35, np.fmax(danger_activation_lo36, np.fmax(danger_activation_lo37,
                        np.fmax(danger_activation_lo38, np.fmax(danger_activation_lo39, np.fmax(danger_activation_lo40,
                        np.fmax(danger_activation_lo41, np.fmax(danger_activation_lo42, np.fmax(danger_activation_lo43,
                        np.fmax(danger_activation_lo44, np.fmax(danger_activation_lo45, np.fmax(danger_activation_md46,
                        np.fmax(danger_activation_md47, np.fmax(danger_activation_md48, np.fmax(danger_activation_md49,
                        np.fmax(danger_activation_md50, np.fmax(danger_activation_md51, np.fmax(danger_activation_md52,
                        np.fmax(danger_activation_md53, np.fmax(danger_activation_md54, np.fmax(danger_activation_md55,
                        np.fmax(danger_activation_md56, np.fmax(danger_activation_md57, np.fmax(danger_activation_md58,
                        np.fmax(danger_activation_md59, np.fmax(danger_activation_md60, np.fmax(danger_activation_md61,
                        np.fmax(danger_activation_md62, np.fmax(danger_activation_md63, np.fmax(danger_activation_hi64,
                        np.fmax(danger_activation_hi65, np.fmax(danger_activation_hi66, np.fmax(danger_activation_hi67,
                        np.fmax(danger_activation_hi68, np.fmax(danger_activation_hi69, np.fmax(danger_activation_hi70,
                        np.fmax(danger_activation_hi71, np.fmax(danger_activation_hi72, np.fmax(danger_activation_vhi73,
                        np.fmax(danger_activation_vhi74, np.fmax(danger_activation_vhi75, np.fmax(danger_activation_vhi76,
                        np.fmax(danger_activation_vhi77, np.fmax(danger_activation_vhi78, np.fmax(danger_activation_vhi79,
                        np.fmax(danger_activation_vhi80, danger_activation_vhi81))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))))
    
    tsum = np.array([np.sum(danger_activation_vlo1), np.sum(danger_activation_vlo2), np.sum(danger_activation_vlo3), 
                     np.sum(danger_activation_vlo4), np.sum(danger_activation_vlo5), np.sum(danger_activation_vlo6), 
                     np.sum(danger_activation_vlo7), np.sum(danger_activation_vlo8), np.sum(danger_activation_vlo9), 
                     np.sum(danger_activation_lo10), np.sum(danger_activation_lo11), np.sum(danger_activation_lo12), 
                     np.sum(danger_activation_lo13), np.sum(danger_activation_lo14), np.sum(danger_activation_lo15), 
                     np.sum(danger_activation_lo16), np.sum(danger_activation_lo17), np.sum(danger_activation_lo18), 
                     np.sum(danger_activation_lo19), np.sum(danger_activation_lo20), np.sum(danger_activation_lo21), 
                     np.sum(danger_activation_lo22), np.sum(danger_activation_lo23), np.sum(danger_activation_lo24), 
                     np.sum(danger_activation_lo25), np.sum(danger_activation_lo26), np.sum(danger_activation_lo27), 
                     np.sum(danger_activation_lo28), np.sum(danger_activation_lo29), np.sum(danger_activation_lo30), 
                     np.sum(danger_activation_lo31), np.sum(danger_activation_lo32), np.sum(danger_activation_lo33), 
                     np.sum(danger_activation_lo34), np.sum(danger_activation_lo35), np.sum(danger_activation_lo36), 
                     np.sum(danger_activation_lo37), np.sum(danger_activation_lo38), np.sum(danger_activation_lo39), 
                     np.sum(danger_activation_lo40), np.sum(danger_activation_lo41), np.sum(danger_activation_lo42), 
                     np.sum(danger_activation_lo43), np.sum(danger_activation_lo44), np.sum(danger_activation_lo45), 
                     np.sum(danger_activation_md46), np.sum(danger_activation_md47), np.sum(danger_activation_md48), 
                     np.sum(danger_activation_md49), np.sum(danger_activation_md50), np.sum(danger_activation_md51), 
                     np.sum(danger_activation_md52), np.sum(danger_activation_md53), np.sum(danger_activation_md54), 
                     np.sum(danger_activation_md55), np.sum(danger_activation_md56), np.sum(danger_activation_md57), 
                     np.sum(danger_activation_md58), np.sum(danger_activation_md59), np.sum(danger_activation_md60), 
                     np.sum(danger_activation_md61), np.sum(danger_activation_md62), np.sum(danger_activation_md63), 
                     np.sum(danger_activation_hi64), np.sum(danger_activation_hi65), np.sum(danger_activation_hi66), 
                     np.sum(danger_activation_hi67), np.sum(danger_activation_hi68), np.sum(danger_activation_hi69), 
                     np.sum(danger_activation_hi70), np.sum(danger_activation_hi71), np.sum(danger_activation_hi72), 
                     np.sum(danger_activation_vhi73), np.sum(danger_activation_vhi74), np.sum(danger_activation_vhi75), 
                     np.sum(danger_activation_vhi76), np.sum(danger_activation_vhi77), np.sum(danger_activation_vhi78), 
                     np.sum(danger_activation_vhi79), np.sum(danger_activation_vhi80), np.sum(danger_activation_vhi81)])
    
    # Find the set with the maximum membership value
    max_set_index = tsum.argmax()
    #print(tsum)
    #print(danger_activation_vlow,danger_activation_low,danger_activation_mid,danger_activation_high, danger_activation_vhigh)
    # Determine the set name based on the index
    if max_set_index <=8:
        max_set = 'Very Low'
    elif max_set_index <=44:
        max_set = 'Low'
    elif max_set_index <= 62:
        max_set = 'Medium'
    elif max_set_index <= 71:
        max_set = 'High'
    else:
        max_set = 'Very High'
    
    # Print the set with the maximum membership value
    print(f"The set with the maximum membership value is: {max_set}")
    # Calculate defuzzified result
    danger = fuzz.defuzz(x_danger, aggregated, 'centroid')
    danger_activation = fuzz.interp_membership(x_danger, aggregated, danger)
    
    # Print the resulting danger percentage
    print(f"The danger percentage is: {danger:.2f}%")
    calc_danger(psname,danger,max_set,cc,cr,cm,cpd)
    P_id=P_id+1;
