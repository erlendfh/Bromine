require 'mysql'
require '../../../Drivers/RC-RUBY/config.rb'

class DBHandler

  def initialize(lang = 'en')
    @lang = lang
    begin
      @dbh = Mysql.new($host, $username, $password, $database)
    rescue Mysql::Error => e
      puts "Error code: #{e.errno}"
      puts "Error message: #{e.error}"
      puts "Error SQLSTATE: #{e.sqlstate}" if e.respond_to?("sqlstate")
    end
  end

  def insert(tableName, values, column)
    @dbh.query("INSERT INTO #{tableName} (#{column}) VALUES (#{values})")
    return @dbh.insert_id
  end


  def disconnect()
    @dbh.close
  end
end
