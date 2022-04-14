jQuery(function(e){e.fn.hScroll=function(l){l=l||120,e(this).bind("DOMMouseScroll mousewheel",function(t){var i=t.originalEvent,n=i.detail?i.detail*-l:i.wheelDelta,o=e(this).scrollLeft();o+=n>0?-l:l,e(this).scrollLeft(o),t.preventDefault()})}});

var video = document.getElementById('video');
var videoLoaded = false;
var videoinputs = [];
var currentInput = 0;

if(navigator.mediaDevices === undefined)
    navigator.mediaDevices = {};

if (navigator.mediaDevices.getUserMedia === undefined) {

    navigator.mediaDevices.getUserMedia = function(varraints) {

        var getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

        if (!getUserMedia)
            return Promise.reject(new Error('getUserMedia is not implemented in this browser'));

        return new Promise(function(resolve, reject) {
            getUserMedia.call(navigator, varraints, resolve, reject);
        });
    }
}

navigator.mediaDevices.enumerateDevices().then(function(devices) {
    devices.forEach(function(device) {
        if(device.kind == 'videoinput')
            videoinputs.push(device);
    });
}).catch(function(err) {
    console.log(err.name + ": " + err.message);
});


var camera, scene, renderer, bg, clock, model, faceModel, predictions;
var textureLoader, textureEquirec;

var container = document.getElementById("scene");
var showroom = document.getElementById('showroom');

var info = new UAParser();
var device = info.getDevice();

var screenOrientation = (window.innerHeight > window.innerWidth) ? 'portrait' : 'landscape';

var gltfLoader = new THREE.GLTFLoader();
// gltfLoader.setPath('/website/virtual_glasses/models/');

var dracoLoader = new THREE.DRACOLoader();
dracoLoader.setDecoderPath('/website/virtual_glasses/js/libs/draco/');
gltfLoader.setDRACOLoader(this.dracoLoader);

var modelLoaded = false;

var sceneInitialized = false;

var glasses, frame, bow_left, bow_right;
var glassesSize = 14.25;
var scaleGlasses = 1;


async function capture(){

    await navigator.mediaDevices.getUserMedia({
        audio: false,
        video: true
    }).then(function(_stream) {

        stream = _stream;

        if ("srcObject" in video)
            video.srcObject = _stream;
        else
            video.src = window.URL.createObjectURL(_stream);

        video.onloadedmetadata = function(e) {
            video.play();
            videoLoaded = true;
        };

    }).catch(function(err) {
        console.dir(err);
        console.log(err.name + ": " + err.message);
    });
}


async function init() {

    await tf.setBackend('wasm');

    faceModel = await faceLandmarksDetection.load(faceLandmarksDetection.SupportedPackages.mediapipeFacemesh);

    renderer = new THREE.WebGLRenderer({
        antialias: true,
        alpha: true,
        preserveDrawingBuffer: true,
        powerPreference: "high-performance"
    });


    if (container.clientWidth > container.clientHeight)
        renderer.setSize(container.clientWidth, (container.clientWidth * video.videoHeight) / video.videoWidth, false);
    else
        renderer.setSize((container.clientHeight * video.videoWidth) / video.videoHeight, container.clientHeight, false);


    textureLoader = new THREE.TextureLoader();

    textureEquirec = textureLoader.load('/website/virtual_glasses/img/env-white.jpg');
    textureEquirec.mapping = THREE.EquirectangularReflectionMapping;
    textureEquirec.encoding = THREE.sRGBEncoding;

    const pmremGenerator = new THREE.PMREMGenerator(renderer);
    pmremGenerator.compileEquirectangularShader();

    scene = new THREE.Scene();
    scenebg = new THREE.Scene();
    camera = new THREE.OrthographicCamera(video.videoWidth / -2, video.videoWidth / 2, video.videoHeight / 2, video.videoHeight / -2, 0.01, 1000);

    camera.position.z = 150;
    camera.position.x = -video.videoWidth/2;
    camera.position.y = -video.videoHeight/2;

    bgTexture = new THREE.Texture(video);
    bgTexture.minFilter = THREE.LinearFilter;
    bg = new THREE.Sprite(new THREE.MeshBasicMaterial({
        map: bgTexture,
        depthWrite: false,
        side: THREE.DoubleSide,
    }));

    scenebg.add(bg);

    bg.center.set(0.5, 0.5);
    bg.scale.set(-video.videoWidth, video.videoHeight, 1);
    bg.position.copy(camera.position);
    bg.position.z = 0;

    container.appendChild( renderer.domElement );

    var light2 = new THREE.DirectionalLight( '#ffffff', 1 );
    scene.add( light2 );

    light = new THREE.HemisphereLight('#fff', '#fff', 1);
    scene.add(light);

    clock = new THREE.Clock();


    await loadModel($("#first_path_inti").attr('data-url'));

    render();

}


async function loadModel(variant){

    document.getElementById('loader').style.display = 'block';
    document.getElementById('loader-value').textContent = '0%';

    if(model)
        scene.remove(model.scene);

    // gltfLoader.load('glasses-'+variant+'.glb?v='+new Date().getTime(), function (gltf) {
    gltfLoader.load(variant + '?v='+ new Date().getTime(), function (gltf) {

        model = gltf;

        model.scene.traverse((o) => {
            if (o.isMesh) {
                o.material.envMap = textureEquirec;
                o.material.envMapIntensity = 2;
                o.material.metalness = 1;
                o.material.roughness = 0;
                o.material.outputEncoding = THREE.sRGBEncoding;
                o.material.needsUpdate = true;
            };
        });

        model.scene.position.x = -video.videoWidth/2;
        model.scene.position.y = -video.videoHeight/3;


        model.scene.scale.set(glassesSize, glassesSize, glassesSize);
        model.scene.rotation.z = THREE.Math.DEG2RAD*90;

        scene.add(model.scene);

        glasses = model.scene.getObjectByName('glasses');
        frame = model.scene.getObjectByName('frame');
        bow_left = model.scene.getObjectByName('bow_left');
        bow_right = model.scene.getObjectByName('bow_right');
        //
        // switch(variant){
        //     case 1:
        //         //set glasses material
        //         glasses.material.transparent = true;
        //         glasses.material.opacity = .85;
        //         glasses.material.metalness = 1;
        //         glasses.material.envMapIntensity = .5;
        //         glasses.material.color = new THREE.Color('#777');
        //         glasses.material.emissive = new THREE.Color('#777');
        //         glasses.material.emissiveIntensity = .5;
        //
        //         //set bows material
        //         bow_left.material.color = new THREE.Color('#333');
        //         bow_left.material.metalness = .5;
        //         bow_left.material.roughness = .5;
        //         bow_left.material.envMap = null;
        //
        //         //set frame material
        //         frame.material.color = new THREE.Color('#333');
        //         frame.material.metalness = .5;
        //         frame.material.roughness = .5;
        //         frame.material.envMap = null;
        //     break;
        //
        //
        //     case 2:
        //         //set glasses material
        //         /*glasses.material.transparent = true;
        //         glasses.material.opacity = .5;
        //         glasses.material.metalness = 1;
        //         glasses.material.envMapIntensity = .5;
        //         glasses.material.color = new THREE.Color('#473620');
        //         glasses.material.emissive = new THREE.Color('#473620');
        //         glasses.material.emissiveIntensity = 1.2;*/
        //         //set bows material
        //         bow_left.material.envMapIntensity = 1;
        //         //set frame material
        //         frame.material.color = new THREE.Color('#ffcc88');
        //         frame.material.metalness = .4;
        //         frame.material.roughness = .6;
        //     break;
        //
        //
        // }

    }, ( xhr ) => {
        var percent = parseInt( (xhr.loaded / xhr.total)*100 );
        document.getElementById('loader-value').textContent = percent+'%';

        if(percent >= 100){
            modelLoaded = true;
            setTimeout(function(){
                document.getElementById('loader').style.display = 'none';
                document.getElementById('showroom-variants').style.display = 'block';
            },500);
        }

    });
}


async function render() {

    bgTexture.needsUpdate = true;

    camera.updateProjectionMatrix();
    renderer.autoClear = true;
    renderer.render(scenebg, camera);
    renderer.autoClear = false;
    renderer.render(scene, camera);

    requestAnimationFrame(render);


    if( videoLoaded && modelLoaded && model ){


        predictions_ = await faceModel.estimateFaces({ input: video, returnTensors: false, flipHorizontal: false });

        if(predictions_.length > 0) {

            predictions = predictions_;

            showroom.style.borderColor = 'orange';
            model.scene.visible = true;

            var boundingBox = new THREE.Box3().setFromObject(model.scene);
            var size = boundingBox.getSize(new THREE.Vector3());


            var mid = predictions[0].annotations.midwayBetweenEyes;
            var leftIris = predictions[0].annotations.leftEyeIris;
            var rightIris = predictions[0].annotations.rightEyeIris;
            var noseBottom = predictions[0].annotations.noseBottom;
            var leftEyeUpper = predictions[0].annotations.leftEyeUpper1;
            var rightEyeUpper = predictions[0].annotations.rightEyeUpper1;

            model.scene.position.x = lerp(model.scene.position.x, -mid[0][0], 0.5);
            model.scene.position.y = lerp(model.scene.position.y, -mid[0][1], 0.5);

            model.scene.up.x = mid[0][0]-noseBottom[0][0];
            model.scene.up.y = mid[0][1]-noseBottom[0][1];
            model.scene.up.z = mid[0][2]-noseBottom[0][2];
			var length = Math.sqrt( model.scene.up.x ** 2 + model.scene.up.y ** 2 + model.scene.up.z ** 2 );
			model.scene.up.x /= length;
			model.scene.up.y /= length;
			model.scene.up.z /= length;


			var eyeDist = Math.sqrt(
                (leftEyeUpper[3][0] - rightEyeUpper[3][0])**2+
                (leftEyeUpper[3][1] - rightEyeUpper[3][1])**2+
                (leftEyeUpper[3][2] - rightEyeUpper[3][2])**2
        	);


        	model.scene.scale.x = eyeDist / (glassesSize/1.9);
            model.scene.scale.y = eyeDist / (glassesSize/1.9);
            model.scene.scale.z = eyeDist / (glassesSize/1.9);

            var angles = calculateFaceAngle(predictions[0].scaledMesh);

            model.scene.rotation.x = angles.pitch;
            model.scene.rotation.y = -angles.yaw;
            model.scene.rotation.z = angles.roll;

            // if(-angles.yaw > 0.09){
            // 	bow_right.visible = true;
            // 	bow_left.visible = false;
            // }else if(-angles.yaw < -0.09){
            // 	bow_left.visible = true;
            // 	bow_right.visible = false;
            // }else{
            // 	bow_left.visible = true;
            // 	bow_right.visible = true;
            // }

        }else{
            model.scene.visible = false;
            showroom.style.borderColor = '#181818';
        }
    }


}


function lerp(start, end, amt){ return (1-amt)*start+amt*end; }


function distance(a, b) {
  return Math.sqrt(Math.pow(a[0] - b[0], 2) + Math.pow(a[1] - b[1], 2));
}


function calculateFaceAngle(mesh){
    if (!mesh) return {};
    const radians = (a1, a2, b1, b2) => Math.atan2(b2 - a2, b1 - a1);
    const angle = {
      roll: radians(mesh[33][0], mesh[33][1], mesh[263][0], mesh[263][1]),
      yaw: radians(mesh[33][0], mesh[33][2], mesh[263][0], mesh[263][2]),
      pitch: radians(mesh[10][1], mesh[10][2], mesh[152][1], mesh[152][2]),
    };
    return angle;
}


function changeVariant(variant,path){

    loadModel(path);

    $('.showroom-variant').removeClass('active');
    $('.showroom-variant-'+variant).addClass('active');
}


async function tryon(){

    if(!sceneInitialized){
        sceneInitialized = true;
        await capture();
        await init();
    }else{
        modelLoaded = true;
    }

    if(device.type == 'mobile' && screenOrientation == 'landscape'){
        $('.orientation-landscape').fadeIn();
        $('#showroom').fadeOut();
    }
};



document.addEventListener("DOMContentLoaded", function(event) {

    tryon();
    $('#showroom-variants').hScroll(100);

});


window.addEventListener('resize', function(){

    if($('body').hasClass('tryon')){
        screenOrientation = (window.innerHeight > window.innerWidth) ? 'portrait' : 'landscape';
        if(device.type == 'mobile' && screenOrientation == 'landscape'){
            $('.orientation-landscape').fadeIn();
            $('#showroom').fadeOut();
        }else{
            $('.orientation-landscape').fadeOut();
            $('#showroom').fadeIn();
        }
    }

});
