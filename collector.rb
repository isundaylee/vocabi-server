require 'rubygems'
require 'json'

nowl = 2
total = 0

wordlists = []

1.upto(nowl) { |wlid|
    open("wordlists/" + wlid.to_s + ".vdm", "r") { |f|
        data = f.read()
        result = JSON.parse(data)
        wordlists += [{"title" => wlid.to_s, "words" => result}]; 
        total += result.size
    }
}

open("collected.json", "w") { |f|
    f.write(wordlists.to_json)
}

puts "Concatenated " + nowl.to_s + " wordlists, in total " + total.to_s + " words. "

version = open("version.php", "r").read().to_i
version += 1
open("version.php", "w").write(version)

puts "Version file updated, now in version " + version.to_s + "."