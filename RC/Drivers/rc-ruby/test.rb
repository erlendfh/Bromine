  require "../../../Drivers/RC-RUBY/fileManager.rb"
  
  class Test
    attr_accessor :name, :status, :passed, :failed, :done

    def initialize(name, verification, logFile)
      @commands = Array.new()
      @name = name
      @status = 'failed'
      @complete = false
      @passed = 0
      @failed = 0
      @done = 0
      @tHelp = ''
      @verification = verification
      @tHelp = "Verification method: <i> #{verification} </i><br />"
      @fm = FileManager.new(logFile)
      @arr = Array.new()
    end
    
    def getLastCommand()
      return @commands[commands.length()-1]
    end
    
    def setHelp(newTxt)
      @tHelp = @tHelp+newTxt
    end
    
    def addResult(command)
      if(command.command == 'testComplete')
        @complete = true
        eval "#{@verification}()"
      elsif(command.status == "passed")
        @passed += 1
      elsif(command.status == "failed")
        @failed +=1
      else
        @done += 1
      end
      @commands.push(command)
      
      cmd = command.toString()
      noOfCmd = 40
      @arr.unshift(cmd)
      @arr.delete_at(noOfCmd)
      @fm.write(@arr, noOfCmd)
    end
    
    def setStatus(newStatus)
      if(newStatus == false)
        @status = "failed"
      else
        @status = 'passed'
      end
    end
    
    def getAsArray()
      i = 0
      @totalComArr = Array.new()
      while i < @commands.size()
        comArr = @commands[i].getAsArray()
        @totalComArr.push(comArr)
        i += 1
      end
      t_arr = Array.new()
      t_arr.push(@name, @status, @complete, @passed, @failed, @done, @verification, @tHelp, @totalComArr)
      return t_arr
    end
  
    def verifyNoneFailed()
      if(@failed > 0)
        @status = "failed"
      else
        @status = "passed"
      end
    end
    
    def verifyAnyCommandTrue(start = 1, stop = 1)
      i = 0
      while i < @commands.size()
        status = @commands[i].status
        if(status == "passed")
          count += 1
        end
        if(count == stop)
          return true
        end
      end
      
      return false
    end
  
    def verifyLastCommandTrue(offset = 1)
      if(@complete == true)
        if(@commands[@commands.size()-offset].status == "passed")
          @status = "passed"
          return true
        end
        else
          @status = "failed"
          return false
        end
      end


    def verifyOnlyLastCommandFalse(offset = 1)
      if(@complete == true)
        if(@commands[@commands.size()-offset].status == failed && @failed == 1)
          @status = "passed"
          return true
        else
          @status = "failed"
          return false
        end
      end
    end
    
    def view(arr)
      puts "*******************<br />"
      puts "Test view:"
      arr.each{|x| print x, " | "}
      puts "<br />"
      puts "*******************<br />"
    end
end
