from selenium import webdriver
from selenium.webdriver.chrome.service import Service
from webdriver_manager.chrome import ChromeDriverManager

import time


driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()))


def checkerror():

    driver.get("https://loki.trentu.ca/~classfind/4000/pickaroom.php")

    driver.find_element("id", "startpoint").send_keys("ahdasdvgs")
    driver.find_element("id", "startroom").send_keys("blm")

    driver.find_element("id", "endpoint").send_keys("other")
    driver.find_element("id", "endroom").send_keys("fbe")

    driver.find_element("name", "submit").click()

    if driver.find_element("class name","error"):
        print("Test Passed")
    else:
        print("Test Failed")

#----------------------------------------------------------------------------------------------------------------

def sqlcheck():

    driver.get("https://loki.trentu.ca/~classfind/4000/updateRoom.php?Room_Code= SELECT * FROM Users;")
    time.sleep(2)

    check = driver.find_element("class name","wrapper")

    time.sleep(2)
    if check:
        print("Test Passed")
    else:
        print("Test Failed")

        time.sleep(2)

#-----------------------------------------------------------------------------------------------------


checkerror()
sqlcheck()





