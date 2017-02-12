### Intended Users
The Dongyue HR system (hrs) is intended for 3 kinds of visitors:

> Those who want to join Dongyue

After info filling and administrator's approval, 
a account for hrs will be assigned to them.

> Dongyue member

Browsing the address book of Dongyue.
*New comers should be able to register other services (GitTq, QA) here.

> Administrator

Editing info of members and teams.
*They should be able to check the application of new comers and approve / reject them.

*For the basic verison of the system, starred design will not be implemented*

### Model
model used to organize database

* User: the user of hrs
* Member: member of Dongyue
* Team: member group of Dongyue

> User & Member

Once one has evolved into Dongyue member, 
he will be assigned a account and become `User`.
? Preserve the account even after one's leaving from Dongyue ?

> Member & Team

* `Member` can attend multiple `Team` 
* `Member` can possess different positions in different `Team` 
* positions includes *president*, *leader*, *HR* and *member* 
* Each `Team` has one and only one *leader* except the *core team*
