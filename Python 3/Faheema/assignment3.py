# assignment3.py
#
# Student name: Faheema Gaibie
# Student id:  V00930468

tests = 0
passed = 0
THRESHOLD = 0.1

FULL_BATTERY_LIFE = 15


def main():
    '''
    Complete this assignment by doing the following
    for each function:
        - uncommenting one test function call in main
          NOTE: each test function has at least one test,
          but you should add additional tests to ensure
          the correctness of your functions

          - complete a full function design for each function
          (write the documentation and define the function)
          NOTE: follow the documentation provided for
          implementing each function in the csc110-assign3.pdf

          - process to the next function by doing the steps
          outlined above until all functions are designed with
          proper documentation, implementation and testing
    '''

    # (int,int,int -> int)
# Takes three integers, and returns the middle value
    def middle_value(a, b, c):
        if a <= b <= c or c <= b <= a:
            return b
        elif b <= a <= c or c <= a <= b:
            return a
        else:
            return c

    def test_middle_value():
        print("beginning tests for middle_value...")
        # TODO: add tests here (and erase this line if you want)
        print(middle_value(7, 8, 6))
        print(middle_value(3, 2, 3))
        print(middle_value(9, 9, 9))

    # (str,str -> str)
# Takes two phrases and appends the longer
# string onto the back of the shorter one
# with no space between the two phrases joined.
    def combine_strings(a, b):
        if(len(a) <= len(b)):
            return a+b
        else:
            return b+a

    def test_combine_strings():
        print("beginning tests for combine_strings...")
    # TODO: add tests here (and erase this line if you want)
    print(combine_strings("water", "melon"))
    print(combine_strings("pine", "apple"))
    print(combine_strings("fruits", "grape"))

    # (str,int -> str)
# Takes a phrase and a number and returns the
# letter at the phrase at the given index
    def get_letter_at(word, a):
        if(a < len(word)):
            return word[a]
        else:
            return " "

    def test_get_letter_at():
        print("beginning tests for get_letter_at...")
        # TODO: add tests here (and erase this line if you want)
        print(get_letter_at("Love", 8))
        print(get_letter_at("Infatuation", 6))
        print(get_letter_at("Intimacy", 0))

    # (int -> float)
    # Takes an integer value that is either 0,
    # 1, 2, or 3 representing the brightness level of a smart phone
    def brightness_modifier(a):
        if(a == 0):
            return 1.0
        elif(a == 1):
            return 0.9
        elif(a == 2):
            return 0.75
        elif(a == 3):
            return 0.5

    def test_brightness_modifier():
        print("beginning tests for brightness_modifier...")
        # TODO: add tests here (and erase this line if you want)
        print(brightness_modifier(0))
        print(brightness_modifier(1))
        print(brightness_modifier(2))
        print(brightness_modifier(3))

    def test_hours_remaining():
        print("beginning tests for hours_remaining...")
        # TODO: add tests here (and erase this line if you want)
        print(hours_remaining(80, 2, True))
        print(hours_remaining(70, 3, False))
        print(hours_remaining(60, 1, False))
        print(hours_remaining(50, 0, True))


# (int,int,bool -> float)
# Takes two integers and a boolean as
# parameters and returns the total hours of battery life left.


    def hours_remaining(battery_remaining, brightness_level, video_streaming):
        reg_battery_rem = (FULL_BATTERY_LIFE*battery_remaining)/100
        brightness_level_battery_life_rem = reg_battery_rem * \
            brightness_modifier(brightness_level)
        if(video_streaming == True):
            total_hours_rem = brightness_level_battery_life_rem/2.0
            return total_hours_rem
        return 0


# (str, bool -> None)
# takes the name or description of a test and whether the
# test produced the expected output (True) or not (False)
# and prints out whether that test passed or failed
# NOTE: You should not have to modify this in any way.


    def print_test(test_name, result_correct):
        global tests
        global passed
        tests += 1
        if(result_correct):
            print(test_name + ": passed")
            passed += 1
        else:
            print(test_name + ": failed")

    # starting
    # ----------------------
    print('Assignment 3')
    test_middle_value()
    test_combine_strings()
    test_get_letter_at()
    test_brightness_modifier()
    test_hours_remaining()
    print("TEST RESULTS:", passed, "/", tests)


# The following code will call your main function
# It also allows our grading script to call your main
# DO NOT ADD OR CHANGE ANYTHING PAST THIS LINE
# DOING SO WILL RESULT IN A ZERO GRADE
if __name__ == '__main__':
    main()
