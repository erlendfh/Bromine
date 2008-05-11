class FileManager

	def initialize(file)
		@file = Dir.getwd + "/" + file
	end

	def read()
		handle = File.open(@file, "r")
		contents = handle.read
		handle.close
		return contents
	end

	def write(arr, noOfCmd)
		handle = File.open(@file, "w")
		i = 0
		while i < arr.size() && i < noOfCmd
			handle.write(arr[i])
			i += 1
		end
		handle.close
	end

	def makeFile()
		handle = File.open(@file, "w")
		handle.close
	end
end 
