<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>
			Tic Tac Toe
		</title>
		<script type="text/javascript">
			//tic-tac-toe game
			//array for HTML elements
			var elems = [	
				[0,0,0],
				[0,0,0],
				[0,0,0]
			] ;
			//array for player 1 points
			var points = [
				[
					[3,2,3],
					[2,4,2],
					[3,2,3]
				],
				[
					[3,2,3],
					[2,4,2],
					[3,2,3]
				]
			]
			;
			
			//array for model of actual spaces
			var space = [	
				[0,0,0],
				[0,0,0],
				[0,0,0]
			] ;
			
			var turn = 1 ;
			var computer = true ;
			function init() {
				//set space array x,y
				for(var x = 0 ; x < elems.length ; x++)
				{
					for(var y = 0; y < elems.length ; y++)
					{	
						//get each space
						elems[y][x] = document.getElementById(y + "-" + x) ;
						//set the event listener
						elems[y][x].addEventListener("click", function(){playerMove(this)});
					}
				}
			}
			
			function playerMove(elem) {
				//first check with spaces to make sure this spot not taken
				if(checkSpace(elem))
				{
					setSpace(elem,turn) ;
					setPoints(elem,turn) ;
					setHTML(elem) ;
					//checkWin(elem) ;
					switchTurn() ;
					if(computer)
						computerMove() ;
				}
			}
			
			function checkSpace(elem) {
				var coor = elem.id.split("-") ;
				var y = coor[0] ;
				var x = coor[1] ;
				
				if(space[y][x] == 0)
					return true
				else
					return false
			}
			
			function setSpace(elem,turn) {
				var coor = elem.id.split("-") ;
				var y = coor[0] ;
				var x = coor[1] ;
				
				space[y][x] = turn ;
			}
			
			function setPoints(elem,turn) {
				//we'll do point calculation for all spaces for only the other player
				var coor = elem.id.split("-") ;
				var y = coor[0] * 1 ;
				var x = coor[1] * 1 ;
				
				//set point arrays by turn
				if(turn == 1)
				{
					var at = 0 ;
					var bt = 1 ;
				}
				else
				{
					var at = 1 ;
					var bt = 0 ;
				}
				
				points[at][y][x] = 0 ;
				points[bt][y][x] = 0 ;
				
				//if bottom of col
				if(typeof space[y-1] !== 'undefined' && typeof space[y-2] !== 'undefined')
				{
					//1st tile is 0
					if(space[y-1][x] == 0)
					{
						points[at][y-1][x] += 1 ;
						points[bt][y-1][x] -= 1 ;
					}
					//1st tile is player's
					else if(space[y-1][x] == turn && space[y-2][x] == 0)
					{
						points[at][y-2][x] += 1 ;
						points[bt][y-2][x] += 4 ;
					}
					//1st tile is opponents
					else if(space[y-1][x] != turn && space[y-2][x] == 0)
					{
						points[at][y-2][x] -= 1 ;
					}
					
					//2nd tile is 0
					if(space[y-2][x] == 0)
					{
						points[at][y-2][x] += 1 ;
						points[bt][y-2][x] -= 1 ;
					}
					//2nd tile is player's
					else if(space[y-2][x] == turn && space[y-1][x] == 0)
					{
						points[at][y-1][x] += 1 ;
						points[bt][y-1][x] += 4 ;
					}
					//2nd tile is opponents
					else if(space[y-2][x] != turn && space[y-1][x] == 0)
					{
						points[at][y-1][x] -= 1 ;
					}
				}
				//if middle of col
				if(typeof space[y-1] !== 'undefined' && typeof space[y+1] !== 'undefined')
				{
					//1st tile is 0
					if(space[y-1][x] == 0)
					{
						points[at][y-1][x] += 1 ;
						points[bt][y-1][x] -= 1 ;
					}
					//1st tile is player's
					else if(space[y-1][x] == turn && space[y+1][x] == 0)
					{
						points[at][y+1][x] += 1 ;
						points[bt][y+1][x] += 4 ;
					}
					//1st tile is opponents
					else if(space[y-1][x] != turn && space[y+1][x] == 0)
					{
						points[at][y+1][x] -= 1 ;
					}
					
					//2nd tile is 0
					if(space[y+1][x] == 0)
					{
						points[at][y+1][x] += 1 ;
						points[bt][y+1][x] -= 1 ;
					}
					//2nd tile is player's
					else if(space[y+1][x] == turn && space[y-1][x] == 0)
					{
						points[at][y-1][x] += 1 ;
						points[bt][y-1][x] += 4 ;
					}
					//2nd tile is opponents
					else if(space[y+1][x] != turn && space[y-1][x] == 0)
					{
						points[at][y-1][x] -= 1 ;
					}
				}
				//if top of col
				if(typeof space[y+1] !== 'undefined' && typeof space[y+2] !== 'undefined')
				{
					//1st tile is 0
					if(space[y+2][x] == 0)
					{
						points[at][y+2][x] += 1 ;
						points[bt][y+2][x] -= 1 ;
					}
					//1st tile is player's
					else if(space[y+2][x] == turn && space[y+1][x] == 0)
					{
						points[at][y+1][x] += 1 ;
						points[bt][y+1][x] += 4 ;
					}
					//1st tile is opponents
					else if(space[y+2][x] != turn && space[y+1][x] == 0)
					{
						points[at][y+1][x] -= 1 ;
					}
					
					//2nd tile is 0
					if(space[y+1][x] == 0)
					{
						points[at][y+1][x] += 1 ;
						points[bt][y+1][x] -= 1 ;
					}
					//2nd tile is player's
					else if(space[y+1][x] == turn && space[y+2][x] == 0)
					{
						points[at][y+2][x] += 1 ;
						points[bt][y+2][x] += 4 ;
					}
					//2nd tile is opponents
					else if(space[y+1][x] != turn && space[y+2][x] == 0)
					{
						points[at][y+2][x] -= 1 ;
					}
				}
				//if left of row
				if(typeof space[y][x+1] != 'undefined' && typeof space[y][x+2] != 'undefined')
				{
					//1st tile is 0
					if(space[y][x+1] == 0)
					{
						points[at][y][x+1] += 1 ;
						points[bt][y][x+1] -= 1 ;
					}
					//1st tile is player's
					else if(space[y][x+1] == turn && space[y][x+2] == 0)
					{
						points[at][y][x+2] += 1 ;
						points[bt][y][x+2] += 4 ;
					}
					//1st tile is opponents
					else if(space[y][x+1] != turn && space[y][x+2] == 0)
					{
						points[at][y][x+2] -= 1 ;
					}
					
					//2nd tile is 0
					if(space[y][x+2] == 0)
					{
						points[at][y][x+2] += 1 ;
						points[bt][y][x+2] -= 1 ;
					}
					//2nd tile is player's
					else if(space[y][x+2] == turn && space[y][x+1] == 0)
					{
						points[at][y][x+1] += 1 ;
						points[bt][y][x+1] += 4 ;
					}
					//2nd tile is opponents
					else if(space[y][x+2] != turn && space[y][x+1] == 0)
					{
						points[at][y][x+1] -= 1 ;
					}
				}
				//if in middle of row
				if(typeof space[y][x-1] != 'undefined' && typeof space[y][x+1] != 'undefined')
				{
					//1st tile is 0
					if(space[y][x+1] == 0)
					{
						points[at][y][x+1] += 1 ;
						points[bt][y][x+1] -= 1 ;
					}
					//1st tile is player's
					else if(space[y][x+1] == turn && space[y][x-1] == 0)
					{
						points[at][y][x-1] += 1 ;
						points[bt][y][x-1] += 4 ;
					}
					//1st tile is opponents
					else if(space[y][x+1] != turn && space[y][x-1] == 0)
					{
						points[at][y][x-1] -= 1 ;
					}
					
					//2nd tile is 0
					if(space[y][x-1] == 0)
					{
						points[at][y][x-1] += 1 ;
						points[bt][y][x-1] -= 1 ;
					}
					//2nd tile is player's
					else if(space[y][x-1] == turn && space[y][x+1] == 0)
					{
						points[at][y][x+1] += 1 ;
						points[bt][y][x+1] += 4 ;
					}
					//2nd tile is opponents
					else if(space[y][x-1] != turn && space[y][x+1] == 0)
					{
						points[at][y][x+1] -= 1 ;
					}
				}
				//if right of row
				if(typeof space[y][x-1] != 'undefined' && typeof space[y][x-2] != 'undefined')
				{
					//1st tile is 0
					if(space[y][x-2] == 0)
					{
						points[at][y][x-2] += 1 ;
						points[bt][y][x-2] -= 1 ;
					}
					//1st tile is player's
					else if(space[y][x-2] == turn && space[y][x-1] == 0)
					{
						points[at][y][x-1] += 1 ;
						points[bt][y][x-1] += 4 ;
					}
					//1st tile is opponents
					else if(space[y][x-2] != turn && space[y][x-1] == 0)
					{
						points[at][y][x-1] -= 1 ;
					}
					
					//2nd tile is 0
					if(space[y][x-1] == 0)
					{
						points[at][y][x-1] += 1 ;
						points[bt][y][x-1] -= 1 ;
					}
					//2nd tile is player's
					else if(space[y][x-1] == turn && space[y][x-2] == 0)
					{
						points[at][y][x-2] += 1 ;
						points[bt][y][x-2] += 4 ;
					}
					//2nd tile is opponents
					else if(space[y][x-1] != turn && space[y][x-2] == 0)
					{
						points[at][y][x-2] -= 1 ;
					}	
				}
				//if top right of up-right diag
				if(typeof space[y+1] != 'undefined' && typeof space[y+2] != 'undefined')
				{
					if(typeof space[y+1][x-1] != 'undefined' && typeof space[y+2][x-2] != 'undefined')
					{
						//1st tile is 0
						if(space[y+1][x-1] == 0)
						{
							points[at][y+1][x-1] += 1 ;
							points[bt][y+1][x-1] -= 1 ;
						}
						//1st tile is play+1er's
						else if(space[y+1][x-1] == turn && space[y+2][x-2] == 0)
						{
							points[at][y+2][x-2] += 1 ;
							points[bt][y+2][x-2] += 4 ;
						}
						//1st tile is opponents
						else if(space[y+1][x-1] != turn && space[y+2][x-2] == 0)
						{
							points[at][y+2][x-2] -= 1 ;
						}
						
						//2nd tile is 0
						if(space[y+2][x-2] == 0)
						{
							points[at][y+2][x-2] += 1 ;
							points[bt][y+2][x-2] -= 1 ;
						}
						//2nd tile is play+1er's
						else if(space[y+2][x-2] == turn && space[y+1][x-1] == 0)
						{
							points[at][y+1][x-1] += 1 ;
							points[bt][y+1][x-1] += 4 ;
						}
						//2nd tile is opponents
						else if(space[y+2][x-2] != turn && space[y+1][x-1] == 0)
						{
							points[at][y+1][x-1] -= 1 ;
						}
					}
				}
				//if middle of up-right diag
				if(typeof space[y-1] != 'undefined' && typeof space[y+1] != 'undefined')
				{
					if(typeof space[y-1][x+1] != 'undefined' && typeof space[y+1][x-1] != 'undefined')
					{
						//1st tile is 0
						if(space[y+1][x-1] == 0)
						{
							points[at][y+1][x-1] += 1 ;
							points[bt][y+1][x-1] -= 1 ;
						}
						//1st tile is play+1er's
						else if(space[y+1][x-1] == turn && space[y-1][x+1] == 0)
						{
							points[at][y-1][x+1] += 1 ;
							points[bt][y-1][x+1] += 4 ;
						}
						//1st tile is opponents
						else if(space[y+1][x-1] != turn && space[y-1][x+1] == 0)
						{
							points[at][y-1][x+1] -= 1 ;
						}
						
						//2nd tile is 0
						if(space[y-1][x+1] == 0)
						{
							points[at][y-1][x+1] += 1 ;
							points[bt][y-1][x+1] -= 1 ;
						}
						//2nd tile is play+1er's
						else if(space[y-1][x+1] == turn && space[y+1][x-1] == 0)
						{
							points[at][y+1][x-1] += 1 ;
							points[bt][y+1][x-1] += 4 ;
						}
						//2nd tile is opponents
						else if(space[y-1][x+1] != turn && space[y+1][x-1] == 0)
						{
							points[at][y+1][x-1] -= 1 ;
						}
					}
				}
				//if bottom left of up right diag 
				if(typeof space[y-1] != 'undefined' && typeof space[y-2] != 'undefined')
				{
					if(typeof space[y-1][x+1] != 'undefined' && typeof space[y-2][x+2] != 'undefined')
					{
						//1st tile is 0
						if(space[y-2][x+2] == 0)
						{
							points[at][y-2][x+2] += 1 ;
							points[bt][y-2][x+2] -= 1 ;
						}
						//1st tile is play+1er's
						else if(space[y-2][x+2] == turn && space[y-1][x+1] == 0)
						{
							points[at][y-1][x+1] += 1 ;
							points[bt][y-1][x+1] += 4 ;
						}
						//1st tile is opponents
						else if(space[y-2][x+2] != turn && space[y-1][x+1] == 0)
						{
							points[at][y-1][x+1] -= 1 ;
						}
						
						//2nd tile is 0
						if(space[y-1][x+1] == 0)
						{
							points[at][y-1][x+1] += 1 ;
							points[bt][y-1][x+1] -= 1 ;
						}
						//2nd tile is play+1er's
						else if(space[y-1][x+1] == turn && space[y-2][x+2] == 0)
						{
							points[at][y-2][x+2] += 1 ;
							points[bt][y-2][x+2] += 4 ;
						}
						//2nd tile is opponents
						else if(space[y-1][x+1] != turn && space[y-2][x+2] == 0)
						{
							points[at][y-2][x+2] -= 1 ;
						}
					}
				}
				//if top left of up-left diag
				if(typeof space[y+1] != 'undefined' && typeof space[y+2] != 'undefined')
				{
					if(typeof space[y+1][x+1] != 'undefined' && typeof space[y+2][x+2] != 'undefined')
					{
						//1st tile is 0
						if(space[y+1][x+1] == 0)
						{
							points[at][y+1][x+1] += 1 ;
							points[bt][y+1][x+1] -= 1 ;
						}
						//1st tile is play+1er's
						else if(space[y+1][x+1] == turn && space[y+2][x+2] == 0)
						{
							points[at][y+2][x+2] += 1 ;
							points[bt][y+2][x+2] += 4 ;
						}
						//1st tile is opponents
						else if(space[y+1][x+1] != turn && space[y+2][x+2] == 0)
						{
							points[at][y+2][x+2] -= 1 ;
						}
						
						//2nd tile is 0
						if(space[y+2][x+2] == 0)
						{
							points[at][y+2][x+2] += 1 ;
							points[bt][y+2][x+2] -= 1 ;
						}
						//2nd tile is play+1er's
						else if(space[y+2][x+2] == turn && space[y+1][x+1] == 0)
						{
							points[at][y+1][x+1] += 1 ;
							points[bt][y+1][x+1] += 4 ;
						}
						//2nd tile is opponents
						else if(space[y+2][x+2] != turn && space[y+1][x+1] == 0)
						{
							points[at][y+1][x+1] -= 1 ;
						}
					}
				}
				//if middle of up-left diag
				if(typeof space[y-1] != 'undefined' && typeof space[y+1] != 'undefined')
				{
					if(typeof space[y-1][x-1] != 'undefined' && typeof space[y+1][x+1] != 'undefined')
					{
						//1st tile is 0
						if(space[y+1][x+1] == 0)
						{
							points[at][y+1][x+1] += 1 ;
							points[bt][y+1][x+1] -= 1 ;
						}
						//1st tile is play+1er's
						else if(space[y+1][x+1] == turn && space[y-1][x-1] == 0)
						{
							points[at][y-1][x-1] += 1 ;
							points[bt][y-1][x-1] += 4 ;
						}
						//1st tile is opponents
						else if(space[y+1][x+1] != turn && space[y-1][x-1] == 0)
						{
							points[at][y-1][x-1] -= 1 ;
						}
						
						//2nd tile is 0
						if(space[y-1][x-1] == 0)
						{
							points[at][y-1][x-1] += 1 ;
							points[bt][y-1][x-1] -= 1 ;
						}
						//2nd tile is play+1er's
						else if(space[y-1][x-1] == turn && space[y+1][x+1] == 0)
						{
							points[at][y+1][x+1] += 1 ;
							points[bt][y+1][x+1] += 4 ;
						}
						//2nd tile is opponents
						else if(space[y-1][x-1] != turn && space[y+1][x+1] == 0)
						{
							points[at][y+1][x+1] -= 1 ;
						}
					}
				}
				//if bottom right of up-left diag 
				if(typeof space[y-1] != 'undefined' && typeof space[y-2] != 'undefined')
				{
					if(typeof space[y-1][x-1] != 'undefined' && typeof space[y-2][x-2] != 'undefined')
					{
						//1st tile is 0
						if(space[y-2][x-2] == 0)
						{
							points[at][y-2][x-2] += 1 ;
							points[bt][y-2][x-2] -= 1 ;
						}
						//1st tile is play+1er's
						else if(space[y-2][x-2] == turn && space[y-1][x-1] == 0)
						{
							points[at][y-1][x-1] += 1 ;
							points[bt][y-1][x-1] += 4 ;
						}
						//1st tile is opponents
						else if(space[y-2][x-2] != turn && space[y-1][x-1] == 0)
						{
							points[at][y-1][x-1] -= 1 ;
						}
						
						//2nd tile is 0
						if(space[y-1][x-1] == 0)
						{
							points[at][y-1][x-1] += 1 ;
							points[bt][y-1][x-1] -= 1 ;
						}
						//2nd tile is play+1er's
						else if(space[y-1][x-1] == turn && space[y-2][x-2] == 0)
						{
							points[at][y-2][x-2] += 1 ;
							points[bt][y-2][x-2] += 4 ;
						}
						//2nd tile is opponents
						else if(space[y-1][x-1] != turn && space[y-2][x-2] == 0)
						{
							points[at][y-2][x-2] -= 1 ;
						}
					}
				}
				
				console.log(points) ;
			}
			
			function setHTML(elem) {
				elem.innerHTML = turn ;
			}
			
			function checkWin(elem) {
				
			}
			
			function switchTurn() {
				if(turn == 1)
					turn = 2 ;
				else
					turn = 1 ;
			}
			
			function computerMove() {
				//set up temp object for highest point places
				var temp = new function() {
					this.y = 0 ;
					this.x = 0 ;
					this.point = 0 ;
				} ;
			
				//go through the point array for this turn
				for(var y = 0 ; y < points[turn-1].length ; y++)
				{
					for(var x = 0 ; x < points[turn-1][y].length ; x++)
					{
						//if this point is higher than make it the place holder
						if(temp.point < points[turn-1][y][x])
						{
							temp.point = points[turn-1][y][x] ;
							temp.y = y ;
							temp.x = x ;
						}
						//else if equal just randomly choose one
						else if(temp.point == points[turn-1][y][x])
						{
							if(Math.floor((Math.random() * 2)) > 0)
							{
								temp.point = points[turn-1][y][x] ;
								temp.y = y ;
								temp.x = x ;
							}
						}
					}
				}
				console.log("AI suggestion y: " + temp.y + " x: " + temp.x + " point: " + temp.point) ;
				
				var elem = elems[temp.y][temp.x] ;
				
				setSpace(elem,turn) ;
				setPoints(elem,turn) ;
				setHTML(elem) ;
				//checkWin(elem) ;
				switchTurn() ;
			}
			
			window.onload = init ;
		</script>
		<style type="text/css">
			.space {
				width: 240px ;
				height: 240px ;
				border: 1px #ccc solid ;
				position: absolute ;
				cursor: pointer ;
			}
			
			.row0 {
				top: 0 ;
			}
			
			.row1 {
				top: 243px ;
			}
			
			.row2 {
				top: 486px ;
			}
			
			.col0 {
				left: 0 ;
			}
			
			.col1 {
				left: 243px ;
			}
			
			.col2 {
				left: 486px ;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="game">
				<div class="menu">
					<div class="title">
						
					</div>
				</div>
				<div class="match">
					<div id="0-0" class="space row0 col0">
					</div>
					<div id="0-1" class="space row0 col1">
					</div>
					<div id="0-2" class="space row0 col2">
					</div>
					<div id="1-0" class="space row1 col0">
					</div>
					<div id="1-1" class="space row1 col1">
					</div>
					<div id="1-2" class="space row1 col2">
					</div>
					<div id="2-0" class="space row2 col0">
					</div>
					<div id="2-1" class="space row2 col1">
					</div>
					<div id="2-2" class="space row2 col2">
					</div>
				</div>
				<div class="game-over">
					
				</div>
			</div>
		</div>
	</body>
</html>