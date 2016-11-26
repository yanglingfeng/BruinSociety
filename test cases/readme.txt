TESTING

The selenium test cases are automated tests to test out all aspects of our features. These are essentially "Black Box" tests. They tests the features from the perspective of users, without any knowledge of our actual code. 

You can run the test cases using Selenium's IDE. Our test cases are encompassed in a test suite, in which there are 3 tests. 

The first test, stored in the file BruinSocietyTesting simply creates 30 new users. 

The second test, stored in MakeAnAccountAndDoStuff restarts. It then creates an account, then does lots of actions that users would likely do. This includes creating new societies, joining societies, chatting with other users, creating discussions and posts, replying to posts, and finally signing out.This is repeated 10 times each, so 10 new users are created and each will go through the test actions. 

The last test case, stored in SignBackInAndDoStuff, signs back into each of the accounts created in the second test, and does more actions. It quits out of some of the societies that the account joined in the second test, then joins other societies, chats with some other users, creates more discussions and posts, and makes more replies, before also signing out.