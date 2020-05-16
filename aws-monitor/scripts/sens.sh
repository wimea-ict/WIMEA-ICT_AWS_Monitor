#!/bin/bash



#Copying files to public folder
tail -1000 /home/administrator/awslistener/data/mubende.dat  > /var/www/html/awsmonitor/aws-monitor/public/files/mubende.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/stationsData/makerere.dat > /var/www/html/awsmonitor/aws-monitor/public/files/makerere.dat
tail -1000 /home/administrator/awslistener/data/entebbe.dat  > /var/www/html/awsmonitor/aws-monitor/public/files/entebbe.dat
tail -1000 /home/administrator/awslistener/data/lwengo.dat   > /var/www/html/awsmonitor/aws-monitor/public/files/lwengo.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/stationsData/buyende_2.dat   > /var/www/html/awsmonitor/aws-monitor/public/files/buyende_2.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/stationsData/jinja.dat   > /var/www/html/awsmonitor/aws-monitor/public/files/jinja.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/stationsData/kamuli.dat   > /var/www/html/awsmonitor/aws-monitor/public/files/kamuli.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/stationsData/mayuge.dat   > /var/www/html/awsmonitor/aws-monitor/public/files/mayuge.dat


#Remove RTC and the comas
awk '{gsub(/,/," ");gsub(/RTC_T=/," ")}1' /var/www/html/awsmonitor/aws-monitor/public/files/mubende.dat   > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mubende.dat
awk '{gsub(/,/," ");gsub(/RTC_T=/," ")}1' /var/www/html/awsmonitor/aws-monitor/public/files/makerere.dat  > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_makerere.dat
awk '{gsub(/,/," ");gsub(/RTC_T=/," ")}1' /var/www/html/awsmonitor/aws-monitor/public/files/entebbe.dat   > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_entebbe.dat
awk '{gsub(/,/," ");gsub(/RTC_T=/," ")}1' /var/www/html/awsmonitor/aws-monitor/public/files/lwengo.dat    > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_lwengo.dat
awk '{gsub(/,/," ");gsub(/RTC_T=/," ")}1' /var/www/html/awsmonitor/aws-monitor/public/files/buyende_2.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_buyende.dat
awk '{gsub(/,/," ");gsub(/RTC_T=/," ")}1' /var/www/html/awsmonitor/aws-monitor/public/files/jinja.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_jinja.dat
awk '{gsub(/,/," ");gsub(/RTC_T=/," ")}1' /var/www/html/awsmonitor/aws-monitor/public/files/kamuli.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_kamuli.dat
awk '{gsub(/,/," ");gsub(/RTC_T=/," ")}1' /var/www/html/awsmonitor/aws-monitor/public/files/mayuge.dat > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mayuge.dat


#Selecting Mubende records for plotting
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mubende.dat | grep mbd-2m     | /bin/seltag -sel V_MCU=%s V_IN=%s T_SHT2X=%s RH_SHT2X=%s | grep -v 'Miss'> /var/www/html/awsmonitor/aws-monitor/public/files/mubende_2m.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mubende.dat | grep mbd-10m    | /bin/seltag -sel V_MCU=%s V_IN=%s P0_LST60=%s V_A1=%s V_A2=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/wd_mubende_10m.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mubende.dat | grep mbd-gnd    | /bin/seltag -sel V_MCU=%s V_IN=%s T1=%s V_A1=%s P0_LST60=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/mubende_gnd.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mubende.dat | grep mbdg3-sink | /bin/seltag -sel V_MCU=%s V_IN=%s T=%s  | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/mubende_sink.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mubende.dat | grep mbd-elec   | /bin/seltag -sel SOC=%s V_BAT=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/mubende_elec.dat
 #Computation for wind direction
awk '{print $1,$2,$3,$4,$5,$6,$7,($6/$7-0.05)*400}' /var/www/html/awsmonitor/aws-monitor/public/files/wd_mubende_10m.dat > /var/www/html/awsmonitor/aws-monitor/public/files/mubende_10m.dat


#Selecting Makerere records for plotting
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_makerere.dat | grep makg3-2m   | /bin/seltag -sel V_MCU=%s V_IN=%s T_SHT2X=%s RH_SHT2X=%s |grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/makerere_2m.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_makerere.dat | grep makg3-10m  | /bin/seltag -sel V_MCU=%s V_IN=%s P0_LST60=%s V_A1=%s V_A2=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/wd_makerere_10m.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_makerere.dat | grep mak-gnd    | /bin/seltag -sel V_MCU=%s V_IN=%s T1=%s V_A1=%s P0_LST60=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/makerere_gnd.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_makerere.dat | grep makg3-sink | /bin/seltag -sel V_MCU=%s V_IN=%s T=%s  | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/makerere_sink.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_makerere.dat | grep mak-elec   | /bin/seltag -sel SOC=%s V_BAT=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/makerere_elec.dat
 #Computation for direction
awk '{print $1,$2,$3,$4,$5,$6,$7,($6/$7-0.05)*400}' /var/www/html/awsmonitor/aws-monitor/public/files/wd_makerere_10m.dat > /var/www/html/awsmonitor/aws-monitor/public/files/makerere_10m.dat


#Selecting Entebbe data for plotting
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_entebbe.dat | grep ebb-2m      | /bin/seltag -sel V_MCU=%s V_IN=%s T_SHT2X=%s RH_SHT2X=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/entebbe_2m.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_entebbe.dat | grep ebbs_10m    | /bin/seltag -sel V_MCU=%s V_IN=%s P0_LST60=%s V_A1=%s V_A2=%s | grep -v 'Miss' | sort > /var/www/html/awsmonitor/aws-monitor/public/files/wd_entebbe_10m.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_entebbe.dat | grep ebb-gnd     | /bin/seltag -sel V_MCU=%s V_IN=%s T1=%s V_A1=%s P0_LST60=%s |grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/entebbe_gnd.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_entebbe.dat | grep ebbg3-sink  | /bin/seltag -sel V_MCU=%s V_IN=%s T=%s  |grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/entebbe_sink.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_entebbe.dat | grep ebbs-elec   | /bin/seltag -sel SOC=%s V_BAT=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/entebbe_elec.dat
 #Computation for wind direction
awk '{print $1,$2,$3,$4,$5,$6,$7,($6/$7-0.05)*400}' /var/www/html/awsmonitor/aws-monitor/public/files/wd_entebbe_10m.dat > /var/www/html/awsmonitor/aws-monitor/public/files/entebbe_10m.dat


#Selecting Lwengo data for plotting
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_lwengo.dat | grep lwg-2m     | /bin/seltag -sel V_MCU=%s V_IN=%s T_SHT2X=%s RH_SHT2X=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/lwengo_2m.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_lwengo.dat | grep lwg-10m    | /bin/seltag -sel V_MCU=%s V_IN=%s P0_LST60=%s V_A1=%s V_A2=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/wd_lwengo_10m.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_lwengo.dat | grep lwg-gnd    | /bin/seltag -sel V_MCU=%s V_IN=%s T1=%s V_A1=%s P0_LST60=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/lwengo_gnd.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_lwengo.dat | grep lwgg3-sink | /bin/seltag -sel V_MCU=%s V_IN=%s T=%s  | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/lwengo_sink.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_lwengo.dat | grep lwg-elec   | /bin/seltag -sel SOC=%s V_BAT=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/tmp_entebbe.dat
 #Computation for wind direction
awk '{print $1,$2,$3,$4,$5,$6,$7,($6/$7-0.05)*400}' /var/www/html/awsmonitor/aws-monitor/public/files/wd_lwengo_10m.dat > /var/www/html/awsmonitor/aws-monitor/public/files/lwengo_10m.dat


#Selecting Buyende records for plotting
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_buyende.dat | grep byd-2-2m     | /bin/seltag -sel V_MCU=%s V_IN=%s T_SHT2X=%s RH_SHT2X=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/buyende_2m.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_buyende.dat | grep byd-2-10m    | /bin/seltag -sel V_MCU=%s V_IN=%s P0_LST60=%s V_A1=%s V_A2=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/wd_buyende_10m.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_buyende.dat | grep byd-2-gnd    | /bin/seltag -sel V_MCU=%s V_IN=%s T1=%s V_A1=%s P0_LST60=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/buyende_gnd.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_buyende.dat | grep byd-2g3-sink | /bin/seltag -sel V_MCU=%s V_IN=%s T=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/buyende_sink.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_buyende.dat | grep byd-2-elec   | /bin/seltag -sel SOC=%s V_BAT=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/buyende_elec.dat
 #Computation for wind direction
awk '{print $1,$2,$3,$4,$5,$6,$7,($6/$7-0.05)*400}' /var/www/html/awsmonitor/aws-monitor/public/files/wd_buyende_10m.dat > /var/www/html/awsmonitor/aws-monitor/public/files/buyende_10m.dat


#Selecting Jinja records for plotting
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_jinja.dat | grep jja-2m     | /bin/seltag -sel V_MCU=%s V_IN=%s T_SHT2X=%s RH_SHT2X=%s | grep -v 'Miss'> /var/www/html/awsmonitor/aws-monitor/public/files/jinja_2m.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_jinja.dat | grep jja-10m    | /bin/seltag -sel V_MCU=%s V_IN=%s P0_LST60=%s V_A1=%s V_A2=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/wd_jinja_10m.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_jinja.dat | grep jja-gnd    | /bin/seltag -sel V_MCU=%s V_IN=%s T1=%s V_A1=%s P0_LST60=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/jinja_gnd.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_jinja.dat | grep jjag3-sink | /bin/seltag -sel V_MCU=%s V_IN=%s T=%s  | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/jinja_sink.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_jinja.dat | grep jjag-elec  | /bin/seltag -sel SOC=%s V_BAT=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/jinja_elec.dat
 #Computation for wind direction
awk '{print $1,$2,$3,$4,$5,$6,$7,($6/$7-0.05)*400}' /var/www/html/awsmonitor/aws-monitor/public/files/wd_jinja_10m.dat > /var/www/html/awsmonitor/aws-monitor/public/files/jinja_10m.dat


#Selecting Kamuli records for plotting
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_kamuli.dat | grep kml-2m     | /bin/seltag -sel V_MCU=%s V_IN=%s T_SHT2X=%s RH_SHT2X=%s | grep -v 'Miss'> /var/www/html/awsmonitor/aws-monitor/public/files/kamuli_2m.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_kamuli.dat | grep kml-10m    | /bin/seltag -sel V_MCU=%s V_IN=%s P0_LST60=%s V_A1=%s V_A2=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/wd_kamuli_10m.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_kamuli.dat | grep kml-gnd    | /bin/seltag -sel V_MCU=%s V_IN=%s T1=%s V_A1=%s P0_LST60=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/kamuli_gnd.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_kamuli.dat | grep ebbg3-sink | /bin/seltag -sel V_MCU=%s V_IN=%s T=%s  | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/kamuli_sink.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_kamuli.dat | grep kml-elec   | /bin/seltag -sel SOC=%s V_BAT=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/kamuli_elec.dat
 #Computation for wind direction
awk '{print $1,$2,$3,$4,$5,$6,$7,($6/$7-0.05)*400}' /var/www/html/awsmonitor/aws-monitor/public/files/wd_kamuli_10m.dat > /var/www/html/awsmonitor/aws-monitor/public/files/kamuli_10m.dat


#Selecting Mayuge records for plotting
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mayuge.dat | grep myg-2m     | /bin/seltag -sel V_MCU=%s V_IN=%s T_SHT2X=%s RH_SHT2X=%s | grep -v 'Miss'> /var/www/html/awsmonitor/aws-monitor/public/files/mayuge_2m.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mayuge.dat | grep myg-10m    | /bin/seltag -sel V_MCU=%s V_IN=%s P0_LST60=%s V_A1=%s V_A2=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/wd_mayuge_10m.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mayuge.dat | grep myg-gnd    | /bin/seltag -sel V_MCU=%s V_IN=%s T1=%s V_A1=%s P0_LST60=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/mayuge_gnd.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mayuge.dat | grep mygg3-sink | /bin/seltag -sel V_MCU=%s V_IN=%s T=%s  | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/mayuge_sink.dat
tail -1000 /var/www/html/awsmonitor/aws-monitor/public/files/tmp_mayuge.dat | grep myg-elec   | /bin/seltag -sel SOC=%s V_BAT=%s | grep -v 'Miss' > /var/www/html/awsmonitor/aws-monitor/public/files/mayuge_elec.dat
 #Computation for wind direction
awk '{print $1,$2,$3,$4,$5,$6,$7,($6/$7-0.05)*400}' /var/www/html/awsmonitor/aws-monitor/public/files/wd_mayuge_10m.dat > /var/www/html/awsmonitor/aws-monitor/public/files/mayuge_10m.dat
