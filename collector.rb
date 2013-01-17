require 'rubygems'
require 'json'

count = 0
total = 0

wordlists = []

Dir['wordlists/*.vdm'].each do |fn|
  title = fn.match(/wordlists\/(.*).vdm/)[1]
    open(fn, "r") { |f|
        data = f.read()
        result = JSON.parse(data)
        wordlists += [{"title" => title, "words" => result}]; 
        total += result.size
        count += 1
    }
end

open("collected.json", "w") { |f|
    f.write(wordlists.to_json)
}

puts "Concatenated " + count.to_s + " wordlists, in total " + total.to_s + " words. "

version = open("version.php", "r").read().to_i
version += 1
open("version.php", "w").write(version)

puts "Version file updated, now in version " + version.to_s + "."