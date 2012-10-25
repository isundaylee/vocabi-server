def generate_key(len = 6)
    allowed = '0123456789ABCDEF'
    return allowed.split('').shuffle[0, len].join
end

puts "Please input the number of keys to generate: "
n = gets.to_i

1.upto(n) {
    key = generate_key
    system('touch keys/' + key)
    puts key
}