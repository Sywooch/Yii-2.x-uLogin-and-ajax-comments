Installation
================================
1. Setup host.
2. Copy source to root dir.
3. Setup DB. Setting file is in \config\db.php
4. Run yii migrations, commands in terminal:
~~~
php yii generate/users
php yii generate/posts
~~~
5. Go to http://localhost/post and enter any post page (http://localhost/post/<postID:\d+>).
6. Play with comments. 

You can change deep of comments by changing "commentsCount" param in \config\params.php
 
Base code was not changed, so here can be some issues, main point was to show ajax post comments, ajax login on post page.

WBR