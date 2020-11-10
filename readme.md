# Laravel API
1. Need to update PHP dependencies `composer update`
2. Create environtment file and set credentials
3. Create DB table `php artisan migrate`

# API endpoints
// Events
    GET     /api/v1/events - All events
    GET     /api/v1/events/{event} - Single Event
    POST    /api/v1/events - Store event

// Comments
    POST    /api/v1/comments/update-status/{comment} - Update comment - is active status
    POST    /api/v1/comments - Create comment
    DELETE  /api/v1/comments - Delete comment
    GET     /api/v1/comments/by-event/{event} - Get comments by event id
    GET     /api/v1/comments - Get all comments
    GET     /api/v1/comments/{comment} - Get single comment