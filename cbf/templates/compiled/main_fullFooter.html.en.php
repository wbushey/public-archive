        <div class="clearRight"></div>
        <div id="bottomInnerCorners" class="innerCorners"></div><!-- Dressing -->
        <div id="commentArea" class="lowerContent">
    <div class="clearRight"></div>
          <h2>Talk Smack about <?php if ($this->options['strict'] || (isset($t->winner) && method_exists($t->winner,'getName'))) echo htmlspecialchars($t->winner->getName());?> and <?php if ($this->options['strict'] || (isset($t->loser) && method_exists($t->loser,'getName'))) echo htmlspecialchars($t->loser->getName());?></h2>
          <div id="comments">
            <div class="pagination">
                <div class="left">
                    <?php echo $t->pg->prv_page;?>
                </div>
                <div class="right">
                    <?php echo $t->pg->next_page;?>
                </div>
                <div class="center">
                    <?php if ($this->options['strict'] || (is_array($t->pg->pg_listings)  || is_object($t->pg->pg_listings))) foreach($t->pg->pg_listings as $listing) {?>
                        <?php echo $listing;?>
                    <?php }?>
                </div>
            </div>
            <?php if ($this->options['strict'] || (is_array($t->comments)  || is_object($t->comments))) foreach($t->comments as $comment) {?>
                <div class="comment">
                    <div class="commentTop">
                      <p class="commenterName">Posted By <?php if ($this->options['strict'] || (isset($comment) && method_exists($comment,'getPosterUsername'))) echo htmlspecialchars($comment->getPosterUsername());?></p>
                      <p class="commentTime">Posted on <?php if ($this->options['strict'] || (isset($comment) && method_exists($comment,'getPostdate'))) echo htmlspecialchars($comment->getPostdate());?></p>
                    </div>
                    <div class="commentBody">
                      <?php if ($this->options['strict'] || (isset($comment) && method_exists($comment,'getPosttext'))) echo $comment->getPosttext();?>
                    </div>
                </div>
            <?php }?>
            <div class="pagination">
                <div class="left">
                    <?php echo $t->pg->prv_page;?>
                </div>
                <div class="right">
                    <?php echo $t->pg->next_page;?>
                </div>
                <div class="center">
                    <?php if ($this->options['strict'] || (is_array($t->pg->pg_listings)  || is_object($t->pg->pg_listings))) foreach($t->pg->pg_listings as $listing) {?>
                        <?php echo $listing;?>
                    <?php }?>
                </div>
            </div>
            <?php echo $t->comment_submission;?>
          </div>
        </div>
      </div><!-- Close Faux -->
      <div class="clearBoth"></div>
      <div id="footer">
        <?php echo $t->footerText;?>
      </div>
      <div id="footerBottom"></div>
    </div>
  </body>
</html>