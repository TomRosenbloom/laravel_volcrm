# Volcrm to do

## Bugs





## Confirmation message

'showing x to y of z results' etc.

## Filters

For e.g. by city, by income band

## Search

This is working pretty well, however, as postcode, aims and activities etc are included in search index they should be visible (with highlighting) in search results.

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

Refer back to email about this and add functionality to look up/cross check orgs in CC API

## Tests

Use TTD to add Opportunity components and functionality.

How do I want this to work:

- Opportunity model:
  - get all opportunities
  - get opportunities for postcode
  - get opportunities within range, x miles of given postcode
  - get opportunities for skill/activity
  - get current opportunities for given Org
- Opportunity controller/views
  - form for adding opportunity

## Code review

SonarQube

## Repository Pattern

Think I might be heading towards this. In OrganisationController->create() I have been debating myself about how best to for e.g. get all cities to pass to the view to populate drop down. Previously I instantiated City, then did query in controller to create a $all_cities var then pass that to the view using view()->with(). Then I tried just directly assigning the query to the view, doing the query in the with array assignments. This saves a possibly pointless var assignment, but I think whatever you do it's wrong to have queries in the controller at all, so next thing is to have a getter method like getForSelect() in the City model, which is where  I'm at now, but... this method is going to be replicated in many models, so is the eventual solution to have a generic sort of controller for these types of objects - and that is where I think we get to repository pattern... 

Should getForSelect be static to avoid a pointless object instantiation? Yes. 

This all makes perfect sense for getForSelect, but not so much for getAll, where I just seem to adding unnecessary steps i.e. because all my getAll does is call self::all(). 

## Logging

Create email alerts to self to log activity i.e. any admin registrations or logins and data changes so I can keep on top of the state of the data.

## Pagination

- Go to correct page of pagination after *adding* an org
- Remember choice of 'items per page'.
- persist search across pagination links
- et-bleeding-cetera

So far my (working) solution has been to create my own PaginationState helper, which uses the session to store and retrieve pagination vars. Using the session is a reasonable thing to do I think - the general issue here is passing values through POST requests. That is, when you for e.g. just use pagination links they are GET requests so the page (and any number of items, if you are allowing this to be editable) can be passed in the url. But when you add or update an item there will be a POST somewhere along the way and you need to pass the pagination vars through this. A standard way of doing this is to use hidden fields etc. but I've never been keen on that and using the session seems a nicer alternative [I can see an obvious reason why this is not the case actually, if you are thinking RESTful then you want everything in the URL. Using the session is in this sense actually a bad idea].

So... for one I think any helper of my own should extend the Laravel paginator. It was a worthwhile exercise doing it the way I have so far, with the contract etc. but probably not best longer term. Second, using the session is a questionable way of doing it.

What values might we want to persist?

- Current page - when an item is edited
- Search terms
- Order by (and direction)
- Items per page

...and we might want to calculate the current page for a new item added, based on current order, and items per page.



just a minute, what is this - my search input is named 'search_terms' but when I use pagination links after search, I get 'query=' in the url. Where is that coming from?? It has to be from paginator object that is being used in view, like {{$organisations->links()}}

This all gets v complicated. I don't understand why this is always such an issue (apparently) in MVC frameworks but doesn't seem properly dealt with anywhere. I must be being stupid in someway because no one else in the world seems to perceive this problem! 

There's several different issues wrapped round each other here: first there is the issue of passing params with pagination links, e.g. search terms, items per page, then there's the issue of persisting params through POST requests, then there is the added complication of what Laravel is doing automatically behind the scenes. Oh and then there's the requirement that any links should be RESTful i.e. the persistence shouldn't rely on use of session vars.

As far as passing params across pagination links goes, that *should* be easy to deal with - just add them to the query string.

NB try searches for Laravel REST pagination/API pagination.

Delving into the Laravel code I see that in AbstractPaginator $query is an array of 'paramaters to add to all URLs'. Then there is  function url() which creates the page link and in which an array of parameters is constructed. That array is initialised as [$this->pageName => $page], where pageName is by default 'page', then for every value of $this->query, a new array pair is added to $parameters. Finally the native function http_build_query is used to add each parameter pair to the url. There are further methods appends(), appendArray(), and addQuery() which between them construct $this->query. appends() and appendArray() both call addQuery(). appends() adds 'a set of query string values to the paginator', appendArray() adds 'an array of query string values'. The documentation describes how appends() can be used to customise the paginator links, but appendArray is not mentioned.

Ok, so I got some success using appends() (in the view, note) to pass search terms and itemsPerPage through the pagination links, but here's the next problem: how to combine a search with (say) orderBy?

When we use 

```
$organisations = Organisation::search($this->searchTerms)->paginate($this->resultsPerPage);
```

...we are using Laravel Scout query builder. If we try and shove an orderBy in there it simply doesn't work:

```
$organisations = Organisation::search($this->searchTerms)->orderBy($this->orderBy)->paginate($this->resultsPerPage);
```

That's more the kind of thing we would do with Eloquent. Weirdly though this doesn't give an error, whereas we will get an error if we replace orderBy with some random nonsense. 

Ahh but of course ordering doesn't make any sense for search results, which should be ordered by relevance... NB it *would* make sense if we used a filter rather than a search

Right so I have sorted out how to pass params in pagination links, now how to remember them through POST requests...

First a recap - when either the search form or the items-per-page form is used (and potentially in future when orderBy or filters say are added) the controller index method picks these up from POST data, then uses them to create paginator object, then returns them (with paginator object) to view where they are added to the paginator links. On a first visit to the index page, there are no params obvs, but they appear as soon as you use a pagination link.

Note also want to remember items per page when clicking on Organisations link in nav bar, and potentially other situations where we might go v far from index list then return - so session must be the way to go?? As far as being RESTful is concerned I suppose you can add to URL from session? Anyway there's literally no other way you can keep hold of a preference like items per page (in fact that particular one could better be preserved in a cookie - although I think it doesn't make much difference with how browsers handle sessions/cookies these days).

So maybe my pagination state helper is correct after all. 