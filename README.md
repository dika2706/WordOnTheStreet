<div align="center">
   <div id="user-content-toc">
      <ul>
         <summary>
            <h1 style="display: inline-block;">Word on the Street</h1>
         </summary>
      </ul>
   </div>
</div>

# Software Description
The goal for this project is to design and create a discussion forum where registered users will have the ability to share their thoughts and opinions through posts and comments in a variety of different forums. For example, when a new iPhone is released, users could go to an Apple Inc. forum to give their thoughts and opinions about the new device. Registered users will also have access to an up-vote/down-vote function, to encourage them to express their approval or disapproval of posts and comments. Non-Registered users will still be able to browse the different forums but will not have access to post or comment on forums, nor interact with them.

# User Groups
- **Registered Account:**
Registered users will be able to post, edit and delete their own material on different forums, also having the ability to post and delete comments on different posts. Registered users can also upvote or downvote posts. These users will also have to ability to view and edit their accounts. 
- **Non-Registered Account:**
Non-registered users will be able to browse through posts and the website. However, they will not have permission to post, comment, and upvote/downvote. Non-registered users will be able to create an account and register if they choose so. 
- **Admin Account:**
Admin accounts may edit or delete any post or comment, with the addition of disabling/enabling accounts, and searching for accounts by username, email or post. Aside from these capabilities, they can act as a registered user as well. Tombstoning

# MVP - Minimum Viable Product 
Our minimimum viable product (MVP) should include base functions as follows:
1. Our website should be able to store data in MySQL - User data, posts, and other information will be stored in MySQL. Individual uses will be further detailed down the list.
2. Contextual menus - Menus change according to the state of the user. For example menus for users logged-in and users who are guests would be different. Some options could be locked or reduced if they are not logged-in for example.
3. PHP server-side scripting
4. User security (ie: prevent injections for SQL) - Use of prepared statements to prevent SQL injection attacks as a form of security.
5. Maintain state - Users will not have to relogin every time they navigate to a different page if they have previously logged on.
6. Asynchronous updates of post threads - Instant post updates when a user stays on a thread.
7. Profile (including photos) stored on MySQL
8. Threads and topic groups - Users are able to access and navigate through a variety of threads and their individual discussions.
9. User feedback design strategy (users always know the state they are in) - Users should always know where they are on the page and how to navigate towards and away from pages.
10. Error handling - When errors occur users are notified and errors are explained (no ambiguity).
11. Password recovery - Ability to have a reset password function sent to users email
12. Admin Accounts - Admin accounts will have a search function, being able to search by name, email, or post. They will also be able to ban/unban users and ability to edit/delete posts.

# Requirements 
- **User Requirements:**
1. Login/logout functionality for users
2. Account recovery option - If a user forgets their password, their will be a account recovery feature which sends them an option to rest their password through email.
3. Ability for registered users to post - registered users will have the ability to browse and post on a various of forums
4. Ability for registered users to comment - registered users will have the ability to comment on whatever post they choose
5. Ability for registered users to upvote/downvote - registered users will be capable of sharing their opinions of posts and comments through and up/down vote system
6. Search functionality for posts for registered users - registered users will also be able to search for a desired post through the various different forums using parts of the posts title
7. Read-only access for non-registered users - non-registered users will only be able to read posts and can't interact with them until they register an account
8. Navigation of different forums for non-registered users - non-registered users will still be able to browse and find different forums

- **Functional Requirements:**

User Account Management:
   - Login/Logout functionality
   - Email recovery feature
   - Adjustable user privileges
   - Self-service for viewing and editing personal account information
 
Search Feature:
   - Powerful search functionality, get command used to find different posts through keywords in the posts
  
Data Storage:
   - Powered by mySQL
   - Seamless integration with PHP for server-side scripting
  
User Experience:
   - Persistent login status, the users will stay in the login status they have last performed
   - Intuitive content presentation
   - Seamless navigation through the website
   - Automatic logout for users who choose to log out
   
Live Messaging Forum:
   - Real-time posts and comments
   - No need for constant page refreshes.

- **Non-functional Requirements:**
1. Robust route guard for secure access to features
   1.1. Access will only be given to the specified user
2. Option to use email/password credentials for login
3. Three distinct account types: registered users, non-registered users, and administrators
4. Prevention of navigation to inaccessible pages.
   4.1. Through pagination integration for enhanced user navigation
   4.2. Elimination of errors in navigation to ensure only accessible material can be viewed

- **Technical Requirements:**
1. Exceptional website uptime approaching 100% availability
2. Protection against SQL injections for security
3. Enhancement of user experience through the use of CSS
4. Speedy performance and quick load times
5. Thorough error handling protocols
6. Graceful guidance of users to alternate paths for seamless task completion.

# Additional Implementations 
1. Tab to display relevant posts (hot posts) - these are posts the exceed a certain number to be considered "hot"
2. Dropdown menu on the different forums to start by date (recent or old posts), or most liked
3. Ability to collaspe all comments on post
   3.1 Posts will only show a maximum of 3 comments before a more function will be displayed for the user to click and be directed to a page where they can view all the comments.


