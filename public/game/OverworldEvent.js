class OverworldEvent {
  constructor({ map, event}) {
    this.map = map;
    this.event = event;
  }

  stand(resolve) {
    const who = this.map.gameObjects[ this.event.who ];
    who.startBehavior({
      map: this.map
    }, {
      type: "stand",
      direction: this.event.direction,
      time: this.event.time
    })
    
    //Set up a handler to complete when correct person is done walking, then resolve the event
    const completeHandler = e => {
      if (e.detail.whoId === this.event.who) {
        document.removeEventListener("PersonStandComplete", completeHandler);
        resolve();
      }
    }
    document.addEventListener("PersonStandComplete", completeHandler)
  }

  walk(resolve) {
    const who = this.map.gameObjects[ this.event.who ];
    who.startBehavior(
      {map: this.map}, 
      {
      type: "walk",
      direction: this.event.direction,
      retry: true
    })

    //Set up a handler to complete when correct person is done walking, then resolve the event
    const completeHandler = e => {
      if (e.detail.whoId === this.event.who) {
        document.removeEventListener("PersonWalkingComplete", completeHandler);
        resolve();
      }
    }
    document.addEventListener("PersonWalkingComplete", completeHandler)

  }

  textMessage(resolve) {

    if (this.event.faceHero) {
      const obj = this.map.gameObjects[this.event.faceHero];
      obj.direction = utils.oppositeDirection(this.map.gameObjects["hero"].direction);
    }

    const message = new TextMessage({
      text: this.event.text,
      onComplete: () => resolve()
    })
    message.init( document.querySelector(".game-container") )
  }

  changeMap(resolve) {

    const sceneTransition = new SceneTransition();
    sceneTransition.init(document.querySelector(".game-container"), () => {
      this.map.overworld.startMap( window.OverworldMaps[this.event.map] );
      resolve();

      sceneTransition.fadeOut();

    })
  }
  changeRoom(resolve){
    const sceneTransition = new SceneTransition();
    sceneTransition.init(document.querySelector(".game-container"), () => {
      this.map.overworld.startMap( new Room().rooms[this.event.map] );
      resolve();

      sceneTransition.fadeOut();

    })
  }
  gate(resolve){
    const which=this.map.gameObjects[ this.event.which];
    if(this.event.what=="open"){
      which.collide && which.collide.forEach(point=>{
        this.map.removeWall(point.x,point.y);
      })
    }
    which.sprite.setAnimation(this.event.type+"-"+this.event.what)
    resolve();
  }
  level(resolve){
    // game.canvas.style.backgroundColor = 'black';
    game.scene.add(this.event.name,levels[this.event.name]);
    game.scene.start(this.event.name);
    resolve();

  }
  init() {
    return new Promise(resolve => {
      this[this.event.type](resolve)      
    })
  }

}
const levels={
  "bubbleSort":BubbleSort,
  "binarySearch":BinarySearch,
  "dijkstra":Dijkstra,
  "mergeSort":MergeSort,
}