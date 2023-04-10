# Analitics SCRUM
WebApp for job performance analisis on SCRUM methodology
<hr>
<h2>Repository directories:</h2>
<ul>
<li>./src 	Has the source code.</li>
</ul>
<hr>
<h2>Database structure (Tickets table):</h2>
<ul>	
	<li>Ticket id (primary key): Jira ticket reference</li>
	<li>Developer (primary key): Developer's name who has developed given ticket</li>
	<li>Project (fulltext key): Project name where this ticket applies</li>
	<li>SP: Story points of the given ticket (value given on sprint plan estimation)</li>
	<li>LW: Log work of the given ticket (reestimation, if applies, once ticket is closed)</li>
	<li>Complexity: How much complex ticket is (of course it's related with LW). Can be 1,2 or 3</li>
	<li>Skill (fulltext key): The skill concept that ticket applies (pe: tear. If any, value "none")</li>
<h2>Features:</h2>
<h3>Developer[i].info</h3>
Provides all informarion related with the ith Developer
<h4>Developer[i].sprints</h4>
<ul>
	<li>Mean all sp closed per dev[i] / all sp closed per all team</li>
	<li>Mean all complex ticket closed per dev[i] / all complex ticket closed per all team</li>
	<li>all sp closed per dev[i] on the sprint where dev[i] closed max sp / all sp closed per all team on the sprint where dev[i] closed max sp. Also which sprint was </li>
	<li>all sp closed per dev[i] on the sprint where dev[i] closed min sp / all sp closed per all team on the sprint where dev[i] closed min sp. Also which sprint was </li>
</ul>
<h4>Developer[i].skills</h4>
<ul>
	<li>Lists all skills gotten from closed tickets: {max1, max2, ... , min2, min3} //all skills != 0</li>
	<li>for each skill from previous list:
	<ul>
	    <li>all tickets closed of given skill for dev[i] / all tickets closed of given skill for all team</li>
	</ul>
	</li>
</ul>
<h4>Developer[i].sprint[j]</h4>
<ul>
	<li>sp closed per dev[i] on sprint[j] / sp closed per all team on sprint[j]</li>
	<li>sp closed per dev[i] on sprint[j] of complex tickets / sp closed per all team on sprint[j] of complex tickets</li>
	<li> TODO: Slack metrics (refinement, trainings...) </li>
</ul>
<h4>Developer[i].skill[j]</h4>
<ul>
	<li>all sp closed per dev[i] of skill[j] / all sp closed per all team of skill[j]</li>
</ul>
<h4> TODO: Growing stats (how much dev[i] grown over the sprints) </h4>
