        <div id="fight" class="mainContent">
          <h1 id="explaination">Who do you think would win a drunken bar fight? Click a picture to decide.</h1>
          <div id="names">
            <div id="celeb1Name" class="celebName">
                <a href="<?php if ($this->options['strict'] || (isset($t->left_fighter) && method_exists($t->left_fighter,'getReference'))) echo htmlspecialchars($t->left_fighter->getReference());?>" target="_blank"><?php if ($this->options['strict'] || (isset($t->left_fighter) && method_exists($t->left_fighter,'getName'))) echo htmlspecialchars($t->left_fighter->getName());?></a>
            </div>
            <div id="celeb2Name" class="celebName">
                <a href="<?php if ($this->options['strict'] || (isset($t->right_fighter) && method_exists($t->right_fighter,'getReference'))) echo htmlspecialchars($t->right_fighter->getReference());?>" target="_blank"><?php if ($this->options['strict'] || (isset($t->right_fighter) && method_exists($t->right_fighter,'getName'))) echo htmlspecialchars($t->right_fighter->getName());?></a>
            </div>
            <div id="vs"><img src="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getLayoutUrl'))) echo htmlspecialchars($t->getLayoutUrl());?>img/vs.png" /></div>
            <div class="clearRight"></div>
          </div> 
          <div id="celeb1" class="celebFight">
            <form action="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getViewUrl'))) echo htmlspecialchars($t->getViewUrl());?>" method="post" id="celeb1Form">
              <input type="hidden" name="winner" value="<?php if ($this->options['strict'] || (isset($t->left_fighter) && method_exists($t->left_fighter,'getId'))) echo htmlspecialchars($t->left_fighter->getId());?>" />
              <div class="largeImgWrapper">
                <img onMouseOver="this.style.cursor='pointer';" onMouseOut="this.style.cursor='auto';" onclick="document.getElementById('celeb1Form').submit()" src="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getPicsUrl'))) echo htmlspecialchars($t->getPicsUrl());?><?php if ($this->options['strict'] || (isset($t->left_fighter) && method_exists($t->left_fighter,'getPic'))) echo htmlspecialchars($t->left_fighter->getPic());?>" alt="<?php if ($this->options['strict'] || (isset($t->left_fighter) && method_exists($t->left_fighter,'getName'))) echo htmlspecialchars($t->left_fighter->getName());?>" />
              </div>
            </form>
          </div>
          <div id="celeb2" class="celebFight">
            <form action="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getViewUrl'))) echo htmlspecialchars($t->getViewUrl());?>" method="post" id="celeb2Form">
              <input type="hidden" name="winner" value="<?php if ($this->options['strict'] || (isset($t->right_fighter) && method_exists($t->right_fighter,'getId'))) echo htmlspecialchars($t->right_fighter->getId());?>" />
              <div class="largeImgWrapper">
                <img onMouseOver="this.style.cursor='pointer';" onMouseOut="this.style.cursor='auto';" onclick="document.getElementById('celeb2Form').submit()" src="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getPicsUrl'))) echo htmlspecialchars($t->getPicsUrl());?><?php if ($this->options['strict'] || (isset($t->right_fighter) && method_exists($t->right_fighter,'getPic'))) echo htmlspecialchars($t->right_fighter->getPic());?>" alt="<?php if ($this->options['strict'] || (isset($t->right_fighter) && method_exists($t->right_fighter,'getName'))) echo htmlspecialchars($t->right_fighter->getName());?>" />
              </div>
            </form>
          </div>
          <div class="clearBoth"></div>
          <h1>If you can't decide, <a href="<?php if ($this->options['strict'] || (isset($t) && method_exists($t,'getViewUrl'))) echo htmlspecialchars($t->getViewUrl());?>">click here</a> for a new fight</h1>
          <h1>Don't know these people? Click on a fighter's name to search Wikipedia</h1>
        </div>