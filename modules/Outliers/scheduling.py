import schedule
import time

def job():
    print("I'm working...")

def ob():
    print("I'm working...")

#schedule.every(10).minutes.do(job)
#schedule.every(2).hour.do(job)
#schedule.every().day.at("12:00").do(job)
#schedule.every().monday.do(job)
#schedule.every().wednesday.at("13:15").do(job)
#schedule.every().minute.at(":05").do(job)

schedule.every(10).seconds.do(job)
schedule.every(10).seconds.do(ob)

while True:
    schedule.run_pending()
    time.sleep(1)