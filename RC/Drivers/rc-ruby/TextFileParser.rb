require "../../../Drivers/RC-RUBY/fileManager.rb"

class TextFileParser
  
  def initialize(file)
    @fm = new FileManager(file)
  end
  
  def load()
    
