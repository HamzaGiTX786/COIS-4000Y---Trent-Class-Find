from selenium import webdriver
from selenium.webdriver.chrome.service import Service
from webdriver_manager.chrome import ChromeDriverManager

import time


driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()))


def checkerror_pickaroom():

    driver.get("https://loki.trentu.ca/~classfind/4000/pickaroom.php")

    driver.find_element("id", "startpoint").send_keys("ahdasdvgs")
    driver.find_element("id", "startroom").send_keys("blm")

    driver.find_element("id", "endpoint").send_keys("other")
    driver.find_element("id", "endroom").send_keys("fbe")

    driver.find_element("name", "submit").click()

    if driver.find_element("class name","error"):
        return "Test Passed"
    else:
        return "Test Failed"

#----------------------------------------------------------------------------------------------------------------

def sqlcheck(page,id):

    driver.get(f"https://loki.trentu.ca/~classfind/4000/{page}?{id}= SELECT * FROM Users;")

    check = driver.find_element("tag name","h2").text

    if check == "Modify & Delete":
        return "Test Passed"
    else:
        return "Test Failed"


#-----------------------------------------------------------------------------------------------------

def pageswithoutget(page):

    driver.get(f"https://loki.trentu.ca/~classfind/4000/{page}")

    check = driver.find_element("tag name","h2").text

    if check == "Modify & Delete":
        return "Test Passed"
    else:
        return "Test Failed"


#checkerror_pickaroom()
print("SQL Injectiong Test: updateEdge.php ->",sqlcheck("updateEdge","Room_Code"))
print("SQL Injectiong Test: updateRoom.php ->",sqlcheck("updateRoom","Room_Code"))
print("SQL Injectiong Test: update.php ->",sqlcheck("update","ID"))
print("SQL Injectiong Test: updateBuilding.php ->",sqlcheck("updateBuilding","ID"))

print("Page without Get: updateEdge.php ->",pageswithoutget("update.php"))
print("Page without Get: updateEdge.php ->",pageswithoutget("updateEdge.php"))
print("Page without Get: updateBuilding.php ->",pageswithoutget("updateBuilding.php"))
print("Page without Get: updateBuilding.php ->",pageswithoutget("updateBuilding.php"))
print("Page without Get: delete.php ->",pageswithoutget("delete.php"))
print("Page without Get: deleteBuilding.php ->",pageswithoutget("deleteBuilding.php"))
print("Page without Get: deleteEdge.php ->",pageswithoutget("deleteEdge.php"))
print("Page without Get: deleteRoom.php ->",pageswithoutget("deleteRoom.php"))






