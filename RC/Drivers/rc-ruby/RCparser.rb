require '../../../Drivers/RC-RUBY/DBHandler.class.rb'
require 'time'

class RCparser

  def initialize(suiteName, suiteStatus, environment, browser, os, noOfPassedTest, noOfFailedTest, noOfCommandsPassed, noOfCommandsFailed, noOfCommandsDone, p_id, timeTaken, arrayOfTests)
    dbh = DBHandler.new()
    time = Time.new()
    #cTime = time.strftime("%Y-%m-%d %H:%M:%S")
    @t = 0
    @c = 0
    @cTotal = 0
    ###################
    ### Suite scope ###
    ###################
    s_id= dbh.insert('TRM_suite',"'','#{suiteName}','#{environment}','#{suiteStatus}',NOW(),'#{timeTaken}','#{browser}','#{os}','RC','','#{noOfPassedTest}','#{noOfFailedTest}','#{noOfCommandsPassed}','#{noOfCommandsFailed}','0','#{p_id}'","ID,suitename,environment,status,timeDate,timeTaken,browser,platform,selenium_version,selenium_revision,numTestPassed,numTestFailed,numCommandsPassed,numCommandsFailed,numCommandsErrors,p_id")
    ####################
    #### Test scope #### 
    ####################
    i = 0
    while i < arrayOfTests.size()
      puts name =  arrayOfTests[i][0]
      t_status =  arrayOfTests[i][1]
      complete =  arrayOfTests[i][2]
      noOfPassed =  arrayOfTests[i][3]
      noOfFailed =  arrayOfTests[i][4]
      noOfDone =  arrayOfTests[i][5]
      verificationMethod =  arrayOfTests[i][6]
      tHelp = arrayOfTests[i][7]
      commandArray =  arrayOfTests[i][8]
      @t += 1
      @cTotal += commandArray.size()
      t_id = dbh.insert('TRM_test',"'','#{t_status}','#{name}','#{s_id}','#{tHelp}'","ID,status,name,s_id,Thelp")
      #####################
      ### Command Scope ###
      #####################
      x = 0
      while x < commandArray.size()
        conArr = commandArray[x]
        command = conArr[0]
        arguments = conArr[1]
        var1 = arguments[0]
        var2  = arguments[1]
        c_status = conArr[2]
        @c += 1
        ccc = dbh.insert('TRM_commands',"'','#{c_status}','#{command}','#{var1}','#{var2}','#{t_id}'","ID,status,action,var1,var2,t_id")
        x += 1
      end
      i += 1
    end
    puts "Successfully inserted: #{@t} out of #{arrayOfTests.size()} tests & #{@c} out of #{@cTotal} commands!"
    dbh.disconnect()
  end

    def view(arr)
      puts "*******************<br />"
      puts "Parser view:"
      arr.each{|x| print x, " | "}
      puts "<br />"
      puts "*******************<br />"
    end
end


	
