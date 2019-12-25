# Authentic Alignment Wellness Theme

## Sass
sass scss/flaxen.scss css/app.css --watch

## Built on Wordpress and Foundation

### CSS Grid Design

- pagination on page-view-results.php works but Im sure it could be cleaner if I just use a wordpress version
- I would guess some of the grids could become flex to make it a little less complex
- scss needs cleaning up and better documentation
- The SVGs for the social menu are pretty scrappy and only work in certain conditions but as I'm working out how the best way to do them for now its fine


### Discovery Form

When sending has a couple of redirects based 

- if nothing comes through from captcha send to /no-captcha
- should send to a /thanks?n=id of the send
- if captcha score is too low /sorry

### Results

only has one option, straight redirect as it shouldn't have any reason to fail, it's a required field so shouldn't be able to get through without a query.

### WP Pages

- Certificates
- Contact // not yet in
- Discovery
- How I got into coaching
- Movement and the great outdoors
- My Programs
- No Captcha
- Privacy policy // draft
- Reccomendations
- Sorry
- Thanks
- The Authentic Alignment mission // front page
- View Results
- View Single