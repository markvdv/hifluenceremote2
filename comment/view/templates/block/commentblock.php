<div class="comment">
    <label>
        <?php echo $this->data['comment']->getCommentTitle(); ?>
    </label>
<!--                    <span>by <?php
//                        if ($this->data['comment']->getCommentauthor()) {
//                            echo $this->data['comment']->getCommentauthor()->getUserName();
//                        } else {
//                            echo "Anonymous";
//                        }
    ?></span>-->
    <div class='text'>
        <?php echo $this->data['comment']->getCommentText(); ?>
    </div>
</div>