import GUI from "https://cdn.jsdelivr.net/npm/lil-gui@0.18.2/+esm"
import { vertexShader, fragmentShader } from './shaders.js';

export class WaveEffect {
    constructor() {

        this.canvasEl = document.querySelector("canvas");
        if (!this.canvasEl) {
            console.error("Canvas element not found");
            return;
        }

        this.imgInput = document.querySelector("#image-selector-input");
        if (!this.imgInput) {
            console.error("Image input element not found");
            return;
        }

        this.devicePixelRatio = Math.min(window.devicePixelRatio, 2);
        this.canvasEl = document.querySelector("canvas");
        this.imgInput = document.querySelector("#image-selector-input");
        this.devicePixelRatio = Math.min(window.devicePixelRatio, 2);
        
        this.params = {
            blueish: .2,
            scale: 12,
            illumination: .15,
            surfaceDistortion: .02,
            waterDistortion: .015,
            loadMyImage: () => {
                this.imgInput.click();
            }
        };

        this.image = null;
        this.uniforms = null;
        this.gl = null;

        // Setup input change handler
        this.imgInput.onchange = () => {
            const [file] = this.imgInput.files;
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    this.loadImage(e.target.result);
                };
                reader.readAsDataURL(file);
            }
        };

        if (this.initWebGL()) {  // Only continue if WebGL initializes successfully
            this.init();
        }
    }

    initWebGL() {
        try {
            this.gl = this.canvasEl.getContext("webgl") || this.canvasEl.getContext("experimental-webgl");
            if (!this.gl) {
                console.error("WebGL is not supported by your browser.");
                return false;
            }
            return true;
        } catch (e) {
            console.error("WebGL initialization failed:", e);
            return false;
        }
    }

    init() {
        if (!this.initShader()) {
            console.error("Shader initialization failed");
            return;
        }
        this.updateUniforms();
        this.loadImage("./assets/images/vlna.jpg");
        this.render();
        window.addEventListener("resize", () => this.resizeCanvas());
    }

    createShader(gl, sourceCode, type) {
        const shader = gl.createShader(type);
        gl.shaderSource(shader, sourceCode);
        gl.compileShader(shader);

        if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) {
            console.error("An error occurred compiling the shaders: " + gl.getShaderInfoLog(shader));
            gl.deleteShader(shader);
            return null;
        }

        return shader;
    }

    createShaderProgram(gl, vertexShader, fragmentShader) {
        const program = gl.createProgram();
        gl.attachShader(program, vertexShader);
        gl.attachShader(program, fragmentShader);
        gl.linkProgram(program);

        if (!gl.getProgramParameter(program, gl.LINK_STATUS)) {
            console.error("Unable to initialize the shader program: " + gl.getProgramInfoLog(program));
            return null;
        }

        return program;
    }

    getUniforms(program) {
        let uniforms = [];
        let uniformCount = this.gl.getProgramParameter(program, this.gl.ACTIVE_UNIFORMS);
        for (let i = 0; i < uniformCount; i++) {
            let uniformName = this.gl.getActiveUniform(program, i).name;
            uniforms[uniformName] = this.gl.getUniformLocation(program, uniformName);
        }
        return uniforms;
    }

    initShader() {
        try {
            const vertexShaderObj = this.createShader(this.gl, vertexShader, this.gl.VERTEX_SHADER);
            const fragmentShaderObj = this.createShader(this.gl, fragmentShader, this.gl.FRAGMENT_SHADER);

            if (!vertexShaderObj || !fragmentShaderObj) {
                console.error("Shader creation failed");
                return false;
            }

            const shaderProgram = this.createShaderProgram(this.gl, vertexShaderObj, fragmentShaderObj);
            if (!shaderProgram) {
                console.error("Shader program creation failed");
                return false;
            }

            this.uniforms = this.getUniforms(shaderProgram);

            const vertices = new Float32Array([-1., -1., 1., -1., -1., 1., 1., 1.]);

            const vertexBuffer = this.gl.createBuffer();
            this.gl.bindBuffer(this.gl.ARRAY_BUFFER, vertexBuffer);
            this.gl.bufferData(this.gl.ARRAY_BUFFER, vertices, this.gl.STATIC_DRAW);

            this.gl.useProgram(shaderProgram);

            const positionLocation = this.gl.getAttribLocation(shaderProgram, "a_position");
            this.gl.enableVertexAttribArray(positionLocation);

            this.gl.bindBuffer(this.gl.ARRAY_BUFFER, vertexBuffer);
            this.gl.vertexAttribPointer(positionLocation, 2, this.gl.FLOAT, false, 0, 0);

            return true;
        } catch (e) {
            console.error("Shader initialization error:", e);
            return false;
        }
    }

    updateUniforms() {
        this.gl.uniform1f(this.uniforms.u_blueish, this.params.blueish);
        this.gl.uniform1f(this.uniforms.u_scale, this.params.scale);
        this.gl.uniform1f(this.uniforms.u_illumination, this.params.illumination);
        this.gl.uniform1f(this.uniforms.u_surface_distortion, this.params.surfaceDistortion);
        this.gl.uniform1f(this.uniforms.u_water_distortion, this.params.waterDistortion);
    }

    loadImage(src) {
        this.image = new Image();
        this.image.crossOrigin = "anonymous";
        this.image.src = src;
        this.image.onload = () => {
            const imageTexture = this.gl.createTexture();
            this.gl.bindTexture(this.gl.TEXTURE_2D, imageTexture);
            this.gl.texParameteri(this.gl.TEXTURE_2D, this.gl.TEXTURE_MIN_FILTER, this.gl.LINEAR);
            this.gl.texParameteri(this.gl.TEXTURE_2D, this.gl.TEXTURE_MAG_FILTER, this.gl.LINEAR);
            this.gl.texParameteri(this.gl.TEXTURE_2D, this.gl.TEXTURE_WRAP_S, this.gl.CLAMP_TO_EDGE);
            this.gl.texParameteri(this.gl.TEXTURE_2D, this.gl.TEXTURE_WRAP_T, this.gl.CLAMP_TO_EDGE);
            this.gl.texImage2D(this.gl.TEXTURE_2D, 0, this.gl.RGBA, this.gl.RGBA, this.gl.UNSIGNED_BYTE, this.image);
            this.gl.uniform1i(this.uniforms.u_image_texture, 0);
            this.resizeCanvas();
        };
    }

    render = () => {
        const currentTime = performance.now();
        this.gl.uniform1f(this.uniforms.u_time, currentTime);
        this.gl.drawArrays(this.gl.TRIANGLE_STRIP, 0, 4);
        requestAnimationFrame(this.render);
    }

    resizeCanvas() {
        const imgRatio = this.image.naturalWidth / this.image.naturalHeight;
        this.canvasEl.width = window.innerWidth * this.devicePixelRatio;
        this.canvasEl.height = window.innerHeight * this.devicePixelRatio;
        this.gl.viewport(0, 0, this.canvasEl.width, this.canvasEl.height);
        this.gl.uniform1f(this.uniforms.u_ratio, this.canvasEl.width / this.canvasEl.height);
        this.gl.uniform1f(this.uniforms.u_img_ratio, imgRatio);
    }
}

// Create instance
try {
    new WaveEffect();
} catch (e) {
    console.error("WaveEffect initialization failed:", e);
}