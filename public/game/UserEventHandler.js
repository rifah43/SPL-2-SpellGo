class UserEventHandler {
    constructor(con) {
        this.ctx = con.ctx;
    }
    createRestartBtn(x, y) {
        this.rst = this.ctx.add.text(x, y, 'Restart', {
            font: '30px CustomFont',
            fill: '#f1c27d',
            align: 'center'
        });
        this.rst.setOrigin(0.5, 0.5); 

        this.rst.setInteractive({ useHandCursor: true });
        this.rst.on('pointerover', () => {
            this.rst.setFill('#ffffff')
            this.rst.setFontSize(35)
        });
        this.rst.on('pointerout', () => {
            this.rst.setFill('#f1c27d')
            this.rst.setFontSize(30)
        });

        this.rst.on('pointerdown',()=>{
                this.ctx.scene.restart();
            
        });
    }
    createContinueBtn() {

    }
    createExitBtn() {

    }
}