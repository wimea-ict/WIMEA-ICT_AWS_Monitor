#!/bin/echo


#add headings
echo Date,V_MCU,V_IN,Temperature,R_Humidity, > /var/www/html/awsmonitor/aws-monitor/public/files/mubende_2m.csv
echo Date,V_MCU,V_IN,P0_LST60,V_A1,V_A2,Degree_WD, > /var/www/html/awsmonitor/aws-monitor/public/files/mubende_10m.csv
echo Date,V_MCU,V_IN,Temperature,V_A1,P0_LST60, > /var/www/html/awsmonitor/aws-monitor/public/files/mubende_gnd.csv
echo Date,V_MCU,V_IN,Temperature, > /var/www/html/awsmonitor/aws-monitor/public/files/mubende_sink.csv
echo Date,SOC,V_BAT, > /var/www/html/awsmonitor/aws-monitor/public/files/mubende_elec.csv

echo Date,V_MCU,V_IN,Temperature,R_Humidity, > /var/www/html/awsmonitor/aws-monitor/public/files/makerere_2m.csv
echo Date,V_MCU,V_IN,P0_LST60,V_A1,V_A2,Degree_WD, > /var/www/html/awsmonitor/aws-monitor/public/files/makerere_10m.csv
echo Date,V_MCU,V_IN,Temperature,V_A1,P0_LST60, > /var/www/html/awsmonitor/aws-monitor/public/files/makerere_gnd.csv
echo Date,V_MCU,V_IN,Temperature, > /var/www/html/awsmonitor/aws-monitor/public/files/makerere_sink.csv
echo Date,SOC,V_BAT, > /var/www/html/awsmonitor/aws-monitor/public/files/makerere_elec.csv

echo Date,V_MCU,V_IN,Temperature,R_Humidity, > /var/www/html/awsmonitor/aws-monitor/public/files/entebbe_2m.csv
echo Date,V_MCU,V_IN,P0_LST60,V_A1,V_A2,Degree_WD, > /var/www/html/awsmonitor/aws-monitor/public/files/entebbe_10m.csv
echo Date,V_MCU,V_IN,Temperature,V_A1,P0_LST60, > /var/www/html/awsmonitor/aws-monitor/public/files/entebbe_gnd.csv
echo Date,V_MCU,V_IN,Temperature, > /var/www/html/awsmonitor/aws-monitor/public/files/entebbe_sink.csv
echo Date,SOC,V_BAT > /var/www/html/awsmonitor/aws-monitor/public/files/entebbe_elec.csv

echo Date,V_MCU,V_IN,Temperature,R_Humidity, > /var/www/html/awsmonitor/aws-monitor/public/files/lwengo_2m.csv
echo Date,V_MCU,V_IN,P0_LST60,V_A1,V_A2,Degree_WD, > /var/www/html/awsmonitor/aws-monitor/public/files/lwengo_10m.csv
echo Date,V_MCU,V_IN,Temperature,V_A1,P0_LST60, > /var/www/html/awsmonitor/aws-monitor/public/files/lwengo_gnd.csv
echo Date,V_MCU,V_IN,Temperature, > /var/www/html/awsmonitor/aws-monitor/public/files/lwengo_sink.csv
echo Date,SOC,V_BAT, > /var/www/html/awsmonitor/aws-monitor/public/files/lwengo_elec.csv

echo Date,V_MCU,V_IN,Temperature,R_Humidity, > /var/www/html/awsmonitor/aws-monitor/public/files/buyende_2m.csv
echo Date,V_MCU,V_IN,P0_LST60,V_A1,V_A2,Degree_WD, > /var/www/html/awsmonitor/aws-monitor/public/files/buyende_10m.csv
echo Date,V_MCU,V_IN,Temperature,V_A1,P0_LST60, > /var/www/html/awsmonitor/aws-monitor/public/files/buyende_gnd.csv
echo Date,V_MCU,V_IN,Temperature, > /var/www/html/awsmonitor/aws-monitor/public/files/buyende_sink.csv
echo Date,SOC,V_BAT, > /var/www/html/awsmonitor/aws-monitor/public/files/buyende_elec.csv

echo Date,V_MCU,V_IN,Temperature,R_Humidity, > /var/www/html/awsmonitor/aws-monitor/public/files/jinja_2m.csv
echo Date,V_MCU,V_IN,P0_LST60,V_A1,V_A2,Degree_WD, > /var/www/html/awsmonitor/aws-monitor/public/files/jinja_10m.csv
echo Date,V_MCU,V_IN,Temperature,V_A1, > /var/www/html/awsmonitor/aws-monitor/public/files/jinja_gnd.csv
echo Date,V_MCU,V_IN,Temperature, > /var/www/html/awsmonitor/aws-monitor/public/files/jinja_sink.csv
echo Date,SOC,V_BAT, > /var/www/html/awsmonitor/aws-monitor/public/files/jinja_elec.csv

echo Date,V_MCU,V_IN,Temperature,R_Humidity, > /var/www/html/awsmonitor/aws-monitor/public/files/kamuli_2m.csv
echo Date,V_MCU,V_IN,P0_LST60,V_A1,V_A2,Degree_WD, > /var/www/html/awsmonitor/aws-monitor/public/files/kamuli_10m.csv
echo Date,V_MCU,V_IN,Temperature,V_A1,P0_LST60, > /var/www/html/awsmonitor/aws-monitor/public/files/kamuli_gnd.csv
echo Date,V_MCU,V_IN,Temperature, > /var/www/html/awsmonitor/aws-monitor/public/files/kamuli_sink.csv
echo Date,SOC,V_BAT, > /var/www/html/awsmonitor/aws-monitor/public/files/kamuli_elec.csv

echo Date,V_MCU,V_IN,Temperature,R_Humidity, > /var/www/html/awsmonitor/aws-monitor/public/files/mayuge_2m.csv
echo Date,V_MCU,V_IN,P0_LST60,V_A1,V_A2,Degree_WD, > /var/www/html/awsmonitor/aws-monitor/public/files/mayuge_10m.csv
echo Date,V_MCU,V_IN,Temperature,V_A1,P0_LST60, > /var/www/html/awsmonitor/aws-monitor/public/files/mayuge_gnd.csv
echo Date,V_MCU,V_IN,Temperature, > /var/www/html/awsmonitor/aws-monitor/public/files/mayuge_sink.csv
echo Date,SOC,V_BAT, > /var/www/html/awsmonitor/aws-monitor/public/files/mayuge_elec.csv


#replace spaces with commas
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/mubende_2m.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mubende_2m.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/mubende_10m.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mubende_10m.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/mubende_gnd.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mubende_gnd.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/mubende_sink.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mubende_sink.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/mubende_elec.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mubende_elec.dat

sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/makerere_2m.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_makerere_2m.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/makerere_10m.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_makerere_10m.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/makerere_gnd.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_makerere_gnd.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/makerere_sink.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_makerere_sink.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/makerere_elec.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_makerere_elec.dat

sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/entebbe_2m.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_entebbe_2m.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/entebbe_10m.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_entebbe_10m.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/entebbe_gnd.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_entebbe_gnd.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/entebbe_sink.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_entebbe_sink.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/entebbe_elec.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_entebbe_elec.dat

sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/lwengo_2m.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_lwengo_2m.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/lwengo_10m.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_lwengo_10m.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/lwengo_gnd.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_lwengo_gnd.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/lwengo_sink.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_lwengo_sink.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/lwengo_elec.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_lwengo_elec.dat

sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/buyende_2m.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_buyende_2m.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/buyende_10m.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_buyende_10m.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/buyende_gnd.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_buyende_gnd.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/buyende_sink.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_buyende_sink.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/buyende_elec.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_buyende_elec.dat

sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/jinja_2m.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_jinja_2m.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/jinja_10m.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_jinja_10m.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/jinja_gnd.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_jinja_gnd.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/jinja_sink.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_jinja_sink.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/jinja_elec.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_jinja_elec.dat

sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/kamuli_2m.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_kamuli_2m.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/kamuli_10m.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_kamuli_10m.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/kamuli_gnd.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_kamuli_gnd.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/kamuli_sink.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_kamuli_sink.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/kamuli_elec.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_kamuli_elec.dat

sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/mayuge_2m.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mayuge_2m.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/mayuge_10m.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mayuge_10m.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/mayuge_gnd.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mayuge_gnd.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/mayuge_sink.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mayuge_sink.dat
sed 's/\s/,/g' /var/www/html/awsmonitor/aws-monitor/public/files/mayuge_elec.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mayuge_elec.dat


#replace first comma with space and remove last character
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mubende_2m.dat  | sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/mubende_2m.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mubende_10m.dat | sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/mubende_10m.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mubende_gnd.dat | sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/mubende_gnd.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mubende_sink.dat| sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/mubende_sink.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mubende_elec.dat| sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/mubende_elec.csv

sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_makerere_2m.dat  | sort | grep -v "^[0]" >> /var/www/html/awsmonitor/aws-monitor/public/files/makerere_2m.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_makerere_10m.dat | sort | grep -v "^[0]" >> /var/www/html/awsmonitor/aws-monitor/public/files/makerere_10m.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_makerere_gnd.dat | sort | grep -v "^[0]" >> /var/www/html/awsmonitor/aws-monitor/public/files/makerere_gnd.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_makerere_sink.dat| sort | grep -v "^[0]" >> /var/www/html/awsmonitor/aws-monitor/public/files/makerere_sink.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_makerere_elec.dat| sort | grep -v "^[0]" >> /var/www/html/awsmonitor/aws-monitor/public/files/makerere_elec.csv

sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_entebbe_2m.dat  | sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/entebbe_2m.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_entebbe_10m.dat | sort | grep -v "^[0]" | grep -v 2018-01-16  >> /var/www/html/awsmonitor/aws-monitor/public/files/entebbe_10m.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_entebbe_gnd.dat | sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/entebbe_gnd.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_entebbe_sink.dat| sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/entebbe_sink.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_entebbe_elec.dat| sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/entebbe_elec.csv

sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_lwengo_2m.dat  | sort | grep -v 2018-01 | grep -v "^[0]" | grep -v 2018-11-01 >> /var/www/html/awsmonitor/aws-monitor/public/files/lwengo_2m.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_lwengo_10m.dat | sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/lwengo_10m.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_lwengo_gnd.dat | sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/lwengo_gnd.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_lwengo_sink.dat| sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/lwengo_sink.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_lwengo_elec.dat| sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/lwengo_elec.csv

sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_buyende_2m.dat  | sort | grep -v "^[0]" | grep -v 20:18:01  >> /var/www/html/awsmonitor/aws-monitor/public/files/buyende_2m.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_buyende_10m.dat | sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/buyende_10m.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_buyende_gnd.dat | sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/buyende_gnd.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_buyende_sink.dat| sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/buyende_sink.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_buyende_elec.dat| sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/buyende_elec.csv

sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_jinja_2m.dat  | sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/jinja_2m.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_jinja_10m.dat | sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/jinja_10m.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_jinja_gnd.dat | sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/jinja_gnd.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_jinja_sink.dat| sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/jinja_sink.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_jinja_elec.dat| sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/jinja_elec.csv

sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_kamuli_2m.dat  | sort | grep -v "^[0]" | grep -v 2018-11-01 | grep -v 2018-11-20 | grep -v 20:32:13 | grep -v 2018-01  >> /var/www/html/awsmonitor/aws-monitor/public/files/kamuli_2m.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_kamuli_10m.dat | sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/kamuli_10m.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_kamuli_gnd.dat | sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/kamuli_gnd.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_kamuli_sink.dat| sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/kamuli_sink.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_kamuli_elec.dat| sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/kamuli_elec.csv

sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mayuge_2m.dat  | sort | grep -v "^[0]" | grep -v 2018-01 | grep -v  2018-11-01  >> /var/www/html/awsmonitor/aws-monitor/public/files/mayuge_2m.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mayuge_10m.dat | sort | grep -v "^[0]" | grep -v 2018-01  >> /var/www/html/awsmonitor/aws-monitor/public/files/mayuge_10m.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mayuge_gnd.dat | sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/mayuge_gnd.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mayuge_sink.dat| sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/mayuge_sink.csv
sed 's/,/ /1;s/.$//' /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mayuge_elec.dat| sort | grep -v "^[0]"  >> /var/www/html/awsmonitor/aws-monitor/public/files/mayuge_elec.csv
