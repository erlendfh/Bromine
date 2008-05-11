#!/usr/bin/ruby
print "Content-type: text/html; charset=utf-8\r\n\r\n";

#require 'test.rb'
#require 'fileManager.rb'
#require 'test.rb'
#require 'command.rb'
#require 'suite.rb'
require 'time'
#require 'dir'
require 'cgi'

  class Dummy

    def initialize
      #testFM()
      #testTime()
      #testRCFramework()
      #arrayCrap()
      #dirCrap()
      abcTest()
    end

    def testTime()

      la = Time.new()

     # la1 = la.asctime

      la1 = la.to_i

      puts la1
    end
      
	def testFM()
	  puts "lal"
	  fm = FileManager.new("RCsuperFil")
	  fm.makeFile()
	  fm.write(["asda","1234","æøå"],3)
	  content = fm.read()
	  puts "æøå"
	  puts content
	end
    
    def testRCFramework()    
      args = Array.new()
      args2 = Array.new()
      args2.push("lala","lala2")
      response = "dummy"
      status = "spiller"
      helpText = "lala ingen hjælp at hente"
      
      cmd1 = Command.new("cmd1", args, response, status)
      cmd2 = Command.new("cmd2", args2, response, status)
      cmd3 = Command.new("cmd3", args, response, status, helpText)
      cmd4 = Command.new("testComplete", args2, response, status)
      
      test = Test.new("Crash Dummy 1", "verifyNoneFailed", "SuperLoggen")
      test.addResult(cmd1)
      test.addResult(cmd2)
      test.addResult(cmd3)
      test.addResult(cmd4)
      
      suite = Suite.new("Dummy sweet")
      suite.addTest(test)
      data = suite.getAsArray()
      #data2 = {"content" => "data", "content 2" => "data"}
      suite.do_post_request("http://dev.testserver.monten.dk/RC/Drivers/RC-RUBY/dummyR2.rb", "content = #{data}")
    end

    def arrayCrap()
      la = Array.new()
      la.push("la1","la2","la3")
      l2 = Array.new()
      l2.push("w00t")
      l2.push(la)
      puts l2[1][1]
    end

    def dirCrap()
	#d = Dir.new()
	puts Dir.getwd
	require "/var/www/dev/RC/rc-ruby/krak.dk/suites/../logs/l"
    end

    def abcTest()
	print CGI::escape("æ __ Æ     ø __ Ø     å __ Å")
    end
  end

blabla = Dummy.new()
