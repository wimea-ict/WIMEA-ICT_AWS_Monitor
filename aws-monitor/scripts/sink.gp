
set title "Wimea-ict Bergen Sink node powered from grid via USB, 1 sample/min"
set term png background rgb "pink"
set term png font ",8" linewidth 1  #set terminal to png with fontsize=8,linewidth=1
set timefmt "%Y-%m-%d %H:%M:%S" #format read from the sens.dat file
set xdata time
set format x "%y%m%d\n%H:%M"
#set format x "%m%d"                      
#set format x "%y%m%d\n%H:%M"                      
#set format x "%y%m%d"
#set format x  "%d/%m"
set datafile missing "85.00"
#set time

set ylabel "Temperature"
set yrange [ -10 : 50 ] noreverse nowriteback
set ytics nomirror
set ytics -10, 10

set style line 1 lt 1 lw 1 pt 3 linecolor rgb "red"

plot "/tmp/mubende2.dat" using 1:5 axes x1y1 title "Temperature" with line ls 1;

