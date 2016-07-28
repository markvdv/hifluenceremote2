
<!--<section>-->

<div id="content">


    <a id="logoutlink" href="/ajax/login/logout">Log Out</a>
    <div id="userprofile">
        <div id="userdata">


            <div class="imgholder">
                <div id="userimage">
                    <!--            <label>
                                    User Profile Picture
                                </label>-->
                    <div>
                        <img src="<?php
                        if (!is_numeric($this->data['user']->getUserimage()) && $this->data['user']->getUserimage() !== null) {
                            echo $this->data['user']->getUserimage()->getBasefilepath() . "/" . $this->data['user']->getUserimage()->getBasefilename();
                        } else {
                            echo "/res/defaultprofilepic.png";
                        }
                        ?>">
                    </div>
                </div>
            </div>
            <div>
                <!--        <div id="userid">
                            <label>
                                User ID
                            </label>
                <?php echo $this->data['user']->getUserid(); ?>
                        </div>-->
            </div>
            <div>
                <div id="usertimestamp">
                    <label>
                        Date Joined
                    </label>
                    <?php echo $this->data['user']->getUsertimestamp(); ?>
                </div>
            </div>
            <div>
                <div id="username">
                    <label>
                        Name
                    </label>
                    <?php echo $this->data['user']->getUsername(); ?>
                </div>
            </div>
            <div>
                <div id="useremail">
                    <label>
                        Email
                    </label>
                    <?php echo $this->data['user']->getUseremail(); ?>
                </div>
            </div>
        </div>
        <div>
            <div id="tags">
                <h4>
                    Tags linked to you
                </h4>
                <div>
                    <?php if ($this->data['user']->getTags()) { ?>
                        <?php
                        foreach ($this->data['user']->getTags() as $tag) {
                            echo $tag->getTagname() . ", ";
                        }
                        ?>
                    <?php } ?>
                </div>
            </div>
            <label>Add a tag</label>
            <?php
            if (isset($this->blocks["addtagform"])) {
                $this->blocks['addtagform']->render();
            }
            ?>
        </div>
        <div id="comments">
            <h4>
                Comments about you
            </h4>
            <?php if ($this->data['user']->getComments()) { ?>
                <?php foreach ($this->data['user']->getComments() as $comment) { ?>
                    <div class="comment">
                        <label>
                            <?php echo $comment->getCommentTitle(); ?>
                        </label>
            <!--                    <span>by <?php
                        if ($comment->getCommentauthor()) {
                            echo $comment->getCommentauthor()->getUserName();
                        } else {
                            echo "Anonymous";
                        }
                        ?></span>-->
                        <div class='text'>
                            <?php echo $comment->getCommentText(); ?>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <!-- add comment form-->
        <label>Leave a comment</label>
        <?php
        if (isset($this->blocks["addcommentform"])) {
            $this->blocks['addcommentform']->render();
        }
        ?>
    </div>
</div>