TESTING - Andrew Lin

— - - - - Selenium Tests — - - - -
The selenium test cases are automated tests to test out all aspects of our features. These are essentially "Black Box" tests. They tests the features from the perspective of users, without any knowledge of our actual code. 

You can run the test cases using Selenium's IDE (a plugin in Firefox). Our test cases are encompassed in a test suite, in which there are 3 tests. I also installed a Selenium add-on, linked from https://github.com/73rhodes/sideflow/blob/master/sideflow.js to allow for loops. 

The first test, stored in the file BruinSocietyTesting simply creates 30 new users. 

The second test, stored in MakeAnAccountAndDoStuff restarts. It then creates an account, then does lots of actions that users would likely do. This includes creating new societies, joining societies, chatting with other users, creating discussions and posts, replying to posts, and finally signing out.This is repeated 10 times each, so 10 new users are created and each will go through the test actions. 

The last test case, stored in SignBackInAndDoStuff, signs back into each of the accounts created in the second test, and does more actions. It quits out of some of the societies that the account joined in the second test, then joins other societies, chats with some other users, creates more discussions and posts, and makes more replies, before also signing out.


— - - - - Mutation Tests — - - - -
The Mutation tests are not automated tests. I changed some code in some files and investigated how this affected the project. Since these have to do with our actual code, this is a “White Box” test. I personally investigated what changes this caused, and I also ran our Selenium test cases. For every changed file, our test suite failed at some point.

I copied these edited files in a separate folder. Here is a summary of my changes and the effects. 

File Changed: app/User.php

Change: Removed User member variable definitions.

Effect: Could not sign up at all. The sign up process was unable to save the information the user provides during signup. Selenium test fails at test 1, when it tries signing up.

Conclusion: This shows that we do indeed need our User class’ member variables, and that our User instantiation is working properly.



File Changed: Resources/views/societyCreation.blade.php

Change: Remove Society Category Field

Effect: Everything else still works, and you can still open the societyCreation.blade.php. However, when trying to create a new Society, it fails when you press the “Create!” button. This is because you are violating an Integrity constraint violation. Selenium tests fail at case 2, where it tries to make a new society.

Conclusion: This shows that our database, in particular the society table, is set up correctly. The Society’s category is a necessary member variable, and our code breaks if you do not provide one.



File Changed: Resources/views/postCreation.blade.php

Change: Removed the hidden definitions of the post’s discussion and society IDs.

Effect: Everything else still works, and you can still open the postCreation.blade.php. In fact, the page still looks exactly the same. However, since the hidden definitions are removed, post creation once again fails after you press the “Create!” button. Once again, this is because the Integrity constraint violation. Selenium tests fail at case 2, when it tries making a new post.

Conclusion: Once again, this shows that our database, in particular the post table, is set up correctly. The post needs a corresponding society and discussion, and this breaks it.



File Changed: Resources/views/postCreation.blade.php (Marked 2 in our Mutation Tests folder)

Change: Instead of removing the hidden definitions of the post’s discussion and society IDs, we set the IDs to a very high and unused value.

Effect: Once again, we can still open the postCreation.blade.php page, and we can still attempt to create a post using the “Create!” button. However, this violates the Posts table’s foreign key constraints, and we receive an error (different from the previous test) accordingly. Selenium once again fails at case 2 when it tries to make a new post.

Conclusion: This shows that not only does our database make sure that a post has a corresponding society and discussion, but it also makes sure that the society and discussion IDs are referencing a valid, existing society and discussion.

