# Volcrm to do

## Logging

Create email alerts to self to log activity i.e. any admin registrations or logins and data changes so I can keep on top of the state of the data.

## Pagination

- Go to correct page of pagination after *adding* an org

- Remember choice of 'items per page'.

So far my (working) solution has been to create my own PaginationState helper, which uses the session to store and retrieve pagination vars. Using the session is a reasonable thing to do I think - the general issue here is passing values through POST requests. That is, when you for e.g. just use pagination links they are GET requests so the page (and any number of items, if you are allowing this to be editable) can be passed in the url. But when you add or update an item there will be a POST somewhere along the way and you need to pass the pagination vars through this. A standard way of doing this is to use hidden fields etc. but I've never been keen on that and using the session seems a nicer alternative [I can see an obvious reason why this is not the case actually, if you are thinking RESTful then you want everything in the URL. Using the session is in this sense actually a bad idea].

So... for one I think any helper of my own should extend the Laravel paginator. It was a worthwhile exercise doing it the way I have so far, with the contract etc. but probably not best longer term. Second, using the session is a questionable way of doing it.

What values might we want to persist?

- Current page - when an item is edited
- Search terms
- Order by (and direction)
- Items per page

...and we might want to calculate the current page for a new item added, based on current order, and items per page.



## Assets

Correct way to add js - compiling to app.js (as per css)

## New functionality

### Volunteers and opportunities

Different user categories for Volunteer, Org User

Volunteer profiles, with skill/activity categories & travel range:

- volunteer table & model - Volunteer should extend and use existing authentication stuff
- opportunity table & model - many to many with organisation
- logic for calculating 'postcodes in range of postcode' - where should that go? In my existing Postcode helper?

### CC API

## Tests

Phpunit

Code review - SonarQube





## Repository Pattern

Think I might be heading towards this. In OrganisationController->create() I have been debating myself about how best to for e.g. get all cities to pass to the view to populate drop down. Previously I instantiated City, then did query in controller to create a $all_cities var then pass that to the view using view()->with(). Then I tried just directly assigning the query to the view, doing the query in the with array assignments. This saves a possibly pointless var assignment, but I think whatever you do it's wrong to have queries in the controller at all, so next thing is to have a getter method like getForSelect() in the City model, which is where  I'm at now, but... this method is going to be replicated in many models, so is the eventual solution to have a generic sort of controller for these types of objects - and that is where I think we get to repository pattern... 

Should getForSelect be static to avoid a pointless object instantiation? Yes. 

This all makes perfect sense for getForSelect, but not so much for getAll, where I just seem to adding unnecessary steps i.e. because all my getAll does is call self::all(). 