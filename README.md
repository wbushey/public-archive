
#cbf

Celebrity Bar Fight - a gag site my friend [David Daedalus](http://www.daviddaedalus.com) and I thought up in 2008 after spending coutless hours in the bar asking our fellow patrons "hey, who do you think would win in a bar fight, Sean Connery or William Shatner?" David currated the fictitious fights, and I coded the site.

This project was as much about learning web development as it was making a fun site, and might be the most coding I have done for a single project (basically everything that isn't a generated class or in boris/vendor/). Things you will find in here include:
 * A crude, self-written model-view-controller framework (Boris) that uses Propel, Flexy, and does some error handling;
 * A weighted ad display system;
 * An administration panel for managing users, banning users, managing advertisments, and adding/removing fights
 * Some circa 2009 ajax and other frustrating-to-look-at Javascript

pics/ is where pictures of fight contestants lives, but I'm not committing those because that seems like a waste of repo space.

#TermsWatch

A project I worked on while an intern at the [Berkman Center](http://cyber.law.harvard.edu/) that is a mix of PHP, Perl, Javascript, and a tiny bit of Python. There were a three phases in the development of TermsWatch
 * Importing the EFF's [TOSBack](http://www.tosback.org/timeline.php) into [symfony](http://www.symfony-project.org/)
 * Writing a Perl website scrapper that scrapped on xpath queries
 * Writing Javascript that allows a user to easily select a DOM element for the scarper (and injecting the JS through a perl proxy).
 * Modifying the BTE algorithm