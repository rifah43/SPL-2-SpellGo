window.speeds = {
    normal: 40,
    pause: 500,
    slow: 120,
    fast: 20
}
window.guidance={
    bubbleSort:{
        swap:[
            
            {text:"If you see the first stair strictly larger than the second one, then swap",speed:window.speeds.normal}
        ],
        skip:[
            {text:"If you see the first stair samller than the second one, then skip",speed:window.speeds.normal}
            
        ]
    },
    binarySearch:{
        pickRight:[
            {text:"If the middle page contains potion name that is lexicographically smaller, then there is no need to check left as left part will only contain potions that are earlier than the desired one.", speed:window.speeds.normal},
            {text:"Simply go to right!",speed:window.speeds.fast }
        ],
        pickLeft:[
            {text:"If the middle page contains potion name that is lexicographically bigger or equal, then there simply go to left as left part may contain earlier reference.", speed:window.speeds.normal},
        ]
    },
    mergeSort:{
        divide:[
            {text:"Keep dividing the branches into two until each branch holds non poisonous fruits. Each new branch will hold half of the total fruits", speed: window.speeds.normal},
            {text:"...", speed:window.speeds.slow},
            {text:"Can you see that a single fruit is non poisonous as it is already sorted?", speed: window.speeds.fast}
        ],
        merge:[
            {text:"Once you find two conquered sorted branch, merge them into one branch. Repeatedly compare the first two fruit in both branch. Pick the smaller one into the new branch until every fruit is picked", speed: window.speeds.normal}
        ]
    },
    dijkstra:{
        minSrc:[
            {text:"Confirm a village with minimum cost.", speed:window.speeds.normal}
        ],
        minAdj:[
            {text:"Only update if going through this path minimizes cost.", speed:window.speeds.normal}
        ]
    },
    kmp:{
        updateAndForward:[
            {text:"Go forward",speed:window.speeds.normal}
        ],
        ignoreAndForward:[
            {text:"Cannot go backward anymore, initialize to 0",speed:window.speeds.normal}
        ],
        backward:[
            {text:"Go backward iteratively until matches.",speed:window.speeds.normal}
        ],
        initialize:[
            {text:"There is nothing before it, we can just never go backward than index 0.", speed:window.speeds.normal},
            {text:"right?", speed:window.speeds.slow},
            {text:"Simply update lps to 0 and move forward!", speed:window.speeds.fast}
        ]
    }
}

window.hints = {
    bubbleSort: {
        swapErr: [
            {text: "Oh no! Magic power was overused while the first stairo swapped the second stairo!",speed: window.speeds.fast},
            {text:"What was wrong?", speed: window.speeds.slow},
            {text:"Better time travel back and fix my mistake!",speed: window.speeds.normal}
        ],
        skipErr: [
            {text:"I must forgot something", speed:window.speeds.normal},
            {text:"...",speed:window.speeds.pause},
            {text:"I should think again.", speed: window.speeds.normal}
        ],
        equalErr: [
            
        ]
    },
    dijkstra:{
        minErr:[
            {text:"This city is already defeated!", speed:window.speeds.fast}
        ],
        naErr:[
            {text:"Pick the city with the minimum cost to get better result.", speed:window.speeds.normal}
        ]
    },
    mergeSort:{
        misstep1:[
            {text:"Divide first, then conquer!", speed:window.speeds.fast}
        ],
        misstep2:[
            {text:"Why dividing when already conquered", speed:window.speeds.normal},
            {text:".....",speed:window.speeds.slow}
        ],
        misstep3:[
            {text:"Maybe the smaller fruit is in the other branch!",speed:window.speeds.fast}
        ]
    },
    binarySearch:{
        pickRight:[
            {text:"As the middle page contains potion that is lexicographically smaller than the desired one, left part will not contain the potion.",speed:window.speeds.normal}
        ],
        pickLeft:[
            {text:"As the middle page contains potion name that is lexicographically bigger, previous pages may contain the desired potion's name.", speed: window.speeds.normal}
        ]
    }
}