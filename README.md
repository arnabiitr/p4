# Project 4
+ By: *Arnab Bhar*
+ Production URL: <http://p4.dwa-fall2018-arnab.me/>

## Database

Primary tables:
  + `members`
  + `claims`
  + `treatments`
 
  
Pivot table(s):
  + `member_treatment`


## CRUD

## Member Operations

__Create__
  + Visit <http://p4.dwa-fall2018-arnab.me/members/create>
  + Fill out form with the following fields
  + First Name : Alphanumeric No Special Characters Allowed
  + Last Name : Alphanumeric No Special Characters Allowed
  + SSN :Alphanumeric (Didn't put a length or type /format limitation since it can vary by state /country /region)
  + Insurance ID card :Alphanumeric
  + DOB :4 digits of Birth Year ( e.g 1979) has to be greater than 1910 else is not accepted 
  + Insurance expiration : 4 digits of expiring year should be greater than 2018 else is not accepted 
  + Address: Alphanumeric 
  + Treatments : Optional Mutliselect ( Refers to any existing treatments the patient has had before )
  
  + Click *Add new Member*
  + Observe confirmation message
  
__Read__
  + Visit <http://p4.dwa-fall2018-arnab.me/members/> see a listing of all Members
  
__Update__
  + Visit <http://p4.dwa-fall2018-arnab.me/members/> choose the Edit button next to one of the Member Name hyperlinks
  + Make some edit to form
  + Click *Save changes*
  + Observe confirmation message
  
__Delete__
  + Visit <http://p4.dwa-fall2018-arnab.me/members/> choose the Delete button next to one of the Member Name hyperlinks
  + Confirm deletion
  + Observe confirmation message
 
## Claim  Operations
 
 __Create__
   + Visit <http://p4.dwa-fall2018-arnab.me/claims/create>
   + Fill out form with the following fields 
   + Diagnosis Code ( Should be in this range ER,GH,AD,ABC,CD,AR,BR,ER)
   + Claim Amount: Numeric
   + Total Amount Paid : Numeric
   + Status Digit (0 - CLOSED , 1 - IN PROGRESS, 2 - PAID)
   
   + Click *Add new Claim*
   + Observe confirmation message
   
 __Read__
   + Visit <http://p4.dwa-fall2018-arnab.me/claims/> see a listing of all claims
   
 __Update__
   + Visit <http://p4.dwa-fall2018-arnab.me/claims/> choose the Edit button next to one of the claims
   + Make some edit to form
   + Click *Save changes*
   + Observe confirmation message
   
 __Delete__
   + Visit <http://p4.dwa-fall2018-arnab.me/claims/> choose the Delete button next to one of the claims
   + Confirm deletion
   + Observe confirmation message

## Outside resources
*used Bootstrap style libraries *

## Code style divergences
*List any divergences from PSR-1/PSR-2 and course guidelines on code style*

## Notes for instructor
*Any notes for me to refer to while grading; if none, omit this section*
