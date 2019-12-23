
def main():
  print('Assignment 3')
 
 
  def middle_value(a,b,c):
    if a <=b <=c or c <=b <=a:
      return b 
    elif b <=a <=c or c <=a <=b:
      return a
    else: 
      return c
  print(middle_value(1,5,4))
 
 # The following code will call your main function
# It also allows our grading script to call your main
# DO NOT ADD OR CHANGE ANYTHING PAST THIS LINE
# DOING SO WILL RESULT IN A ZERO GRADE
if __name__ == '__main__':
    main()
