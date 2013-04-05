Progress
---

A simple and clean progress application to give more insights of a project.

Progress shows you on a simple way the:
- Running projects
- Deadlines of the projects
- Team members of a project
- Upcoming projects
- Time and date
- Birthdays of your co-workers

![Alt text](http://goedonthouden.com/dump/progress-front.jpg "Project overview")
![Alt text](http://goedonthouden.com/dump/progress-backend.jpg "Progress admin panel")

I developed Progress within 24 hours in my own spare time. Just because we needed a more "we" feeling on the running projects at my work.
To keep it fun 24 hours was the maximum of time I wanted to spent on the project and then see if the project is viable or not. Since I'm a front-end developer I didn't spent a lot of time on the back-end code since that's no fun for me. So if you are a back-end developer and willing to contribute then please go ahead and fork the project.
Debugging for IE7 & IE8 is no fun. That's why I didn't do a browser check. And since it's a tool for internal use and everyone at the office here is super awesome and uses a modern browser there was no need to make it look good on ancient browsers.

I've tested progress with the following browsers:
- Apple Safari (v5.1.7) - has some minor issues like not obeying to the HTML5 input required tag
- Apple Safari (v6.0.3) - does not obey the HTML5 input required tag
- Mozilla Firefox (v19.0.2)
- Google Chrome (v25.0.1364.172 m)
- Microsoft Internet Explorer 10
- Microsoft Internet Explorer 9 - does not obey the HTML5 input required tag

I'm now trying to make this work on Node.js. Just for fun and to learn some Node.

Dependencies
---
Progress should work with the most versions of the following software:
- Apache
- PHP
- MySQL

Instructions
---
1. Upload all the files to your webserver.
2. Change the database settings in connect.php.
3. Insert the database dump from the database folder.
4. Add a department.
5. Add an employee.
6. Add a project.
7. Send me a heads up that you are using my application. I'd love to hear from you! [@PizzaPete](http://www.twitter.com/PizzaPete/ "Follow me on Twitter")

License
---
Copyright 2013 Pieter Bogaerts - [Goedonthouden.com](http://www.goedonthouden.com/ "My Personal Homepage")

Progress is licenced under the MIT Licence - http://opensource.org/licenses/mit-license.php

The following libraries are being used by Progress:
- Date Range Picker for Twitter Bootstrap by Dan Grosman is licenced under the Apache Licence, Version 2.0 - http://www.apache.org/licenses/LICENSE-2.0
- DateJS by Coolite INC. is licenced under the MIT Licence - http://www.datejs.com/license/
- Twitter Bootstrap by Mark Otto and Jacob Thornton is licenced under the Apache Licence, Version 2.0 - http://www.apache.org/licenses/LICENSE-2.0
- jQuery Tablesorter is licenced under the MIT Licence - http://opensource.org/licenses/mit-license.php

Disclaimer
---
Progress was developed within 24 hours by a front-end developer. My goal for this application was making something viable within 24 hours and keeping it fun. Keeping it fun means no hardcore back-end development for me so that's why the admin screen isn't password protected. Also the MySQL queries are pretty straight forward and I did my best to avoid SQL injections but as I mentioned before I'm a real front-end developer and I didn't spent much time on back-end security. 

That's the reason why I can't be held responsible for any damage or data loss that may occur by using this application. If you are a real back-end developer and like to improve my code please go ahead and fork my repo. 

Todo
---
- Make the application look good on big television screens.

Changelog
---
- v1.0 - Added the possibility to edit and remove employees and departments.
- v0.9 - Added the possibility to edit a project.
