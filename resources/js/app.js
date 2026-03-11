import './bootstrap';
import "flyonui/flyonui"
import "node-waves/dist/waves.css"


document.addEventListener("livewire:navigated", function () {
    window.HSStaticMethods.autoInit()
    Waves.init()
    Waves.attach('.waves')
})
