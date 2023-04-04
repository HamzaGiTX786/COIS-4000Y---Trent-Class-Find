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

    if driver.find_element("class name","error").is_displayed():
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
    
#------------------------------------------------------------------------------------------------------

'''
def checkdeleteedeg():
    driver.get("https://loki.trentu.ca/~classfind/4000/modify")

   # link = driver.
'''

#-------------------------------------------------------------------------------------------------

def login():
    driver.get("https://loki.trentu.ca/~classfind/4000/admin")

    driver.find_element("id","username").send_keys("h")
    driver.find_element("id","password").send_keys("1")

    driver.find_element("name","submit").click()

#----------------------------------------------------------------------------------------------

def createnodecheck():

    login()

    driver.get("https://loki.trentu.ca/~classfind/4000/createNode.php")

    driver.find_element("id", "ID").send_keys("100")
    driver.find_element("id", "Location").send_keys("somewhere")

    driver.find_element("id", "Name").send_keys("NodeOfThrones")
    driver.find_element("id", "building").send_keys("ac")
    neighbours = driver.find_elements("id", "Neighbours")

    neighbours[15].click()

    driver.find_element("name", "submit").click()

    title = driver.title

    if title == "Admin Backend:Trent Class Find - Backend":
        return "Test Passed"
    else:
        return "Test Failed"
    
#-------------------------------------------------------------------------------------------------

def makeaccount():

    # login()

    driver.get("https://loki.trentu.ca/~classfind/4000/createaccount")

    driver.find_element("id", "fname").send_keys("first")
    driver.find_element("id", "lname").send_keys("last")
    driver.find_element("id", "email").send_keys("first@last.trentu.ca")
    driver.find_element("id", "username").send_keys("user1")
    driver.find_element("id", "password").send_keys("password1")
    driver.find_element("id", "passwordre").send_keys("password1")
    driver.find_element("id", "can_create_users").send_keys("Yes")
    driver.find_element("id", "canchangebuilding").send_keys("Yes")
    driver.find_element("id", "can_create_node").send_keys("Yes")
    driver.find_element("id", "can_create_route").send_keys("Yes")
    driver.find_element("id", "can_create_rooms").send_keys("Yes")
    driver.find_element("id", "updateimage").send_keys("Yes")

    driver.find_element("name", "submit").click()

    title = driver.title

    if title == "Admin Backend:Trent Class Find - Backend":
        return "Test Passed"
    else:
        return "Test Failed"



print("Pickaroom error test ->",checkerror_pickaroom())
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

print("Make a Node ->",createnodecheck())

print("Create an account ->",makeaccount())







