import './bootstrap';
import "flyonui/flyonui"
import Waves from "node-waves"
import "node-waves/dist/waves.css"


document.addEventListener("livewire:navigated", function () {
    window.HSStaticMethods.autoInit()
    Waves.init()
    Waves.attach('.waves')
})
