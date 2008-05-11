class Command
  
  attr_accessor :status, :command

	def initialize(command, args, response, status, helpText = "")
		@command = command
		@args = args
		@response = response
		@status = status
		@helpText = helpText
    #view()
	end

	def toString()
    if(@args.size() == 0)
      @args[0] = ""
      @args[1] = ""
    elsif(@args.size() == 1)
      @args[1] = ""
    end
		if(@status == "passed")
			bgcolor = "status_passed"
		elsif(@status == "failed")
			bgcolor = "status_failed"
		else
			bgcolor = "status_done"
		end
		return "<tr class=#{bgcolor}><td>#{@command}</td><td>#{@args[0]}</td><td>#{@args[1]}</td><td>#{@response}</td></tr>\n"
	end

	def setStatus(newStatus)
		if(newStatus == "passed" || newStatus == "failed")
			@status = newStatus
		end
	end

  def getAsArray()
    arr = Array.new()
    arr.push(@command)
    arr.push(@args)
    arr.push(@status)
    return arr
  end
  
  def view()
    puts "*******************<br />"
    puts "Command: #{@command}<br />"
    puts "Arguments:"
    @args.each{|x| print x, " | "}
    puts "<br />"
    puts "Response: #{@response}<br />"
    puts "Status: #{@status}<br />"
    puts "*******************<br />"
  end
end