require "../../../Drivers/RC-RUBY/fileManager.rb"
require "cgi"
require "net/http"
require "../../../Drivers/RC-RUBY/RCparser.rb"

class Suite
  
  def initialize(name = "AUTONAME: Test Suite")
    cgi = CGI.new
    @sTime = Time.new()
    @sTime = @sTime.to_i
    puts "Suite #{name} Created!<br />"
    @name = name
    @status = 'passed'
    @environment = cgi["sitetotest"]
    @browser = cgi["browser"]
    @b_id = cgi["b_id"]
    @platform = cgi["OS"]
    @p_id = cgi["p_id"]    
    @tests = Array.new()
    @passed = 0
    @failed = 0
    @cPassed = 0
    @cFailed = 0
    @cDone = 0
  end
  
  def checkStatus(test)
    return test.status
  end
  
  def changeStatus(status)
    @status = status
  end
  
  def addTest(newTest)
    puts "Test: #{newTest.name} added!<br />"
    @tests.push(newTest)
    if(checkStatus(newTest) == "failed")
      @status = "failed"
      @failed +=1
    else
      @passed += 1
    end
    @cPassed += newTest.passed
    @cFailed += newTest.failed
    @cDone += newTest.done
  end
  
  def getAsArray()
    i = 0
    testsArr = Array.new()
    while i < @tests.size()
 
      ar1a = @tests[i].getAsArray()
      testsArr.push(ar1a)
      i += 1
    end
    return testsArr
  end
  
  def getTime()
     eTime = Time.new()
     eTime = eTime.to_i
    sec = eTime - @sTime
    return sec
  end

  def sendResult()
    puts "Posting started!<br />"
    testsArr = getAsArray()
    parser = RCparser.new(@name, @status, @environment, @b_id, @platform, @passed, @failed, @cPassed, @cFailed, @cDone, @p_id, getTime(), testsArr)
    puts "Posting done<br />" 
  end

    def view(arr)
      puts "*******************<br />"
      puts "Suite view:"
      arr.each{|x| print x, " | "}
      puts "<br />"
      puts "*******************<br />"
    end
end
