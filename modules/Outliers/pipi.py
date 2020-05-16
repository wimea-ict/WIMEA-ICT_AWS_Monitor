import outcode as grubbs
import mysql.connector
from decimal import Decimal
import numpy as np
import schedule
import time


mydb = mysql.connector.connect(
    host="localhost",
    user="admin",
    passwd="admin1234",
    database="wdrDb"

)

mycursor = mydb.cursor()

#*********TWO METERS***********************



def T_SHT2X_col():
    mycursor.execute("SELECT id,T_SHT2X,stationID  FROM T_SHT2X  WHERE T_SHT2X ORDER BY id DESC LIMIT 3000")

    gather=mycursor.fetchall()


    arr1 = []
    arr = []
    stationid=[]


    for x in gather:
        arr1.append(x[0])

        arr.append(float(x[1]))
        stationid.append(x[2])

    data = np.array(arr)
    g = grubbs.test(data, alpha=0.05)


    b=grubbs.two_sided_test_indices(data, alpha=0.05)
    print(b)





    for i in  arr:
        if i not in g:
            print(str(i)+ " is an outlier")





    for o in b:
        mycursor.execute("INSERT INTO DetectedAnalyzerProblems(Problem,stationID,NodeId,Value) VALUES ('outlier',{},{},{})".format(stationid[o],arr1[o],arr[o]))

        #mycursor.execute("INSERT INTO DetectedAnalyzerProblems(Problem,stationID,NodeId,Value) VALUES ('outlier',{},{},{})".format(stationid[o],arr1[o],arr[o]))


        mycursor.execute("UPDATE  TwoMeterNode SET checked ='checked'  where id ={}".format(arr1[o]))


    mydb.commit()





def R_SHT2X_col():
    mycursor.execute("SELECT id,RH_SHT2X,stationID  FROM RH_SHT2X where RH_SHT2X ORDER BY id DESC LIMIT 3000")

    gather=mycursor.fetchall()

    #gather=mycursor.fetchmany(1000)

    arr1 = []
    arr = []
    stationid=[]


    for x in gather:
        arr1.append(x[0])

        arr.append(float(x[1]))
        stationid.append(x[2])


    data = np.array(arr)
    g = grubbs.test(data, alpha=0.05)
    #print(g)

    b=grubbs.two_sided_test_indices(data, alpha=0.05)
    print(b)





    for i in  arr:
        if i not in g:
            print(str(i)+ " is an outlier")



    for o in b:
        mycursor.execute("INSERT INTO DetectedAnalyzerProblems(Problem,stationID,valueid,outvalue) VALUES ('outlierforR',{},{},{})".format(stationid[o],arr1[o],arr[o]))

        #mycursor.execute("INSERT INTO DetectedAnalyzerProblems(Problem,stationID,NodeId,Value) VALUES ('outlier',{},{},{})".format(stationid[o],arr1[o],arr[o]))

        mycursor.execute("UPDATE  TwoMeterNode SET checkr ='checked'  where id ={}".format(arr1[o]))

    mydb.commit()


#*********TEN METERS***********************


def V_A1():
    mycursor.execute("SELECT id,V_A1,stationID  FROM TenMeters WHERE V_A1 ORDER BY id DESC LIMIT 3000")

    gather=mycursor.fetchall()

    #gather=mycursor.fetchmany(1000)

    arr1 = []
    arr = []
    stationid=[]


    for x in gather:
        arr1.append(x[0])

        arr.append(float(x[1]))
        stationid.append(x[2])

    data = np.array(arr)
    g = grubbs.test(data, alpha=0.05)
    #print(g)

    b=grubbs.two_sided_test_indices(data, alpha=0.05)
    print(b)





    for i in  arr:
        if i not in g:
            print(str(i)+ " is an outlier")



    for o in b:
        mycursor.execute("INSERT INTO DetectedAnalyzerProblems(Problem,stationID,valueid,outvalue) VALUES ('outlierforV_A1',{},{},{})".format(stationid[o],arr1[o],arr[o]))


    mydb.commit()



def V_A2():
    mycursor.execute("SELECT id,V_A2,stationID  FROM TenMeters WHERE V_A2 ORDER BY id DESC LIMIT 3000")

    gather=mycursor.fetchall()

    #gather=mycursor.fetchmany(1000)

    arr1 = []
    arr = []
    stationid=[]


    for x in gather:
        arr1.append(x[0])

        arr.append(float(x[1]))
        stationid.append(x[2])




    data = np.array(arr)
    g = grubbs.test(data, alpha=0.05)
    #print(g)

    b=grubbs.two_sided_test_indices(data, alpha=0.05)
    print(b)





    for i in  arr:
        if i not in g:
            print(str(i)+ " is an outlier")



    for o in b:
        mycursor.execute("INSERT INTO DetectedAnalyzerProblems(Problem,stationID,valueid,outvalue) VALUES ('outlierforV_A2',{},{},{})".format(stationid[o],arr1[o],arr[o]))



    mydb.commit()


#V_A2()

def V_AD1():
    mycursor.execute("SELECT id,V_AD1,stationID  FROM TenMeters WHERE V_AD1 ORDER BY id DESC LIMIT 3000")

    gather=mycursor.fetchall()

    #gather=mycursor.fetchmany(1000)

    arr1 = []
    arr = []
    stationid=[]


    for x in gather:
        arr1.append(x[0])

        arr.append(float(x[1]))
        stationid.append(x[2])



    data = np.array(arr)
    g = grubbs.test(data, alpha=0.05)
    #print(g)

    b=grubbs.two_sided_test_indices(data, alpha=0.05)
    print(b)





    for i in  arr:
        if i not in g:
            print(str(i)+ " is an outlier")



    for o in b:
        mycursor.execute("INSERT INTO DetectedAnalyzerProblems(Problem,stationID,valueid,outvalue) VALUES ('outlierforV_AD1',{},{},{})".format(stationid[o],arr1[o],arr[o]))



    mydb.commit()


#V_AD1()


def V_AD2():
    mycursor.execute("SELECT id,V_AD2,stationID  FROM TenMeters WHERE V_AD2 ORDER BY id DESC ")

    gather=mycursor.fetchall()

    #gather=mycursor.fetchmany(1000)

    arr1 = []
    arr = []
    stationid=[]


    for x in gather:
        arr1.append(x[0])

        arr.append(float(x[1]))
        stationid.append(x[2])



    data = np.array(arr)
    g = grubbs.test(data, alpha=0.05)
    #print(g)

    b=grubbs.two_sided_test_indices(data, alpha=0.05)
    print(b)





    for i in  arr:
        if i not in g:
            print(str(i)+ " is an outlier")



    for o in b:
        mycursor.execute("INSERT INTO DetectedAnalyzerProblems(Problem,stationID,valueid,outvalue) VALUES ('outlierforV_AD2',{},{},{})".format(stationid[o],arr1[o],arr[o]))



    mydb.commit()



def V_A2():
    mycursor.execute("SELECT id,V_A2,stationID  FROM TenMeters WHERE V_A2 ORDER BY id DESC LIMIT 3000")

    gather=mycursor.fetchall()

    #gather=mycursor.fetchmany(1000)

    arr1 = []
    arr = []
    stationid=[]


    for x in gather:
        arr1.append(x[0])

        arr.append(float(x[1]))
        stationid.append(x[2])



    data = np.array(arr)
    g = grubbs.test(data, alpha=0.05)
    #print(g)

    b=grubbs.two_sided_test_indices(data, alpha=0.05)
    print(b)





    for i in  arr:
        if i not in g:
            print(str(i)+ " is an outlier")



    for o in b:
        mycursor.execute("INSERT INTO DetectedAnalyzerProblems(Problem,stationID,valueid,outvalue) VALUES ('outlierforV_A2',{},{},{})".format(stationid[o],arr1[o],arr[o]))




    mydb.commit()






#*********GROUND NODES***********************



def G_V_A1():
    mycursor.execute("SELECT id,V_A1,stationID  FROM GND WHERE V_A1 ORDER BY id DESC LIMIT 3000")

    gather=mycursor.fetchall()
    arr1 = []
    arr = []
    stationid=[]


    for x in gather:
        arr1.append(x[0])

        arr.append(float(x[1]))
        stationid.append(x[2])

    data = np.array(arr)
    g = grubbs.test(data, alpha=0.05)
    #print(g)

    b=grubbs.two_sided_test_indices(data, alpha=0.05)
    print(b)

    for i in  arr:
        if i not in g:
            print(str(i)+ " is an outlier")



    for o in b:
        mycursor.execute("INSERT INTO DetectedAnalyzerProblems(Problem,stationID,valueid,outvalue) VALUES ('outlierfor GV_A1',{},{},{})".format(stationid[o],arr1[o],arr[o]))




    mydb.commit()





def G_V_A2():
    mycursor.execute("SELECT id,V_A2,stationID  FROM GND WHERE V_A2 ORDER BY id DESC LIMIT 3000")

    gather=mycursor.fetchall()
    arr1 = []
    arr = []
    stationid=[]


    for x in gather:
        arr1.append(x[0])

        arr.append(float(x[1]))
        stationid.append(x[2])

    data = np.array(arr)
    g = grubbs.test(data, alpha=0.05)
    #print(g)

    b=grubbs.two_sided_test_indices(data, alpha=0.05)
    print(b)

    for i in  arr:
        if i not in g:
            print(str(i)+ " is an outlier")



    for o in b:
        mycursor.execute("INSERT INTO DetectedAnalyzerProblems(Problem,stationID,valueid,outvalue) VALUES ('outlierfor GV_A2',{},{},{})".format(stationid[o],arr1[o],arr[o]))




    mydb.commit()


T_SHT2X_col()
#R_SHT2X_col()
# schedule.every(2).hour.do(V_A1)
# schedule.every(2).hour.do(V_A2)
# schedule.every(2).hour.do(V_AD1)
# schedule.every(2).hour.do(G_V_A1)
# schedule.every(2).hour.do(G_V_A2)


# while True:
#     schedule.run_pending()
#     time.sleep(1)





