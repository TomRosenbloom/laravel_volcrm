# Volcrm to do

Create email alerts to self to log activity i.e. any admin registrations or logins and data changes so I can keep on top of the state of the data.

Go to correct page of pagination after *adding* an org

Correct way to add js - compiling to app.js (as per css)

Anonymise data? Should be ok as it is just public contact data, but just to be on safe side... 

Different user categories for Volunteer, Org User

Volunteer profiles, with skill/activity categories & travel range:

- volunteer table & model - Volunteer should extend and use existing authentication stuff
- opportunity table & model - many to many with organisation
- logic for calculating 'postcodes in range of postcode' - where should that go? In my existing Postcode helper?

Phpunit

Code review - SonarQube

CC API



## Repository Pattern

Think I might be heading towards this. In OrganisationController->create() I have been debating myself about how best to for e.g. get all cities to pass to the view to populate drop down. Previously I instantiated City, then did query in controller to create a $all_cities var then pass that to the view using view()->with(). Then I tried just directly assigning the query to the view, doing the query in the with array assignments. This saves a possibly pointless var assignment, but I think whatever you do it's wrong to have queries in the controller at all, so next thing is to have a getter method like getForSelect() in the City model, which is where  I'm at now, but... this method is going to be replicated in many models, so is the eventual solution to have a generic sort of controller for these types of objects - and that is where I think we get to repository pattern... 

Should getForSelect be static to avoid a pointless object instantiation?