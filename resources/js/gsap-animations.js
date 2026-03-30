import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";
import { Draggable } from "gsap/all";

gsap.registerPlugin(ScrollTrigger, Draggable);

document.addEventListener("DOMContentLoaded", () => {
    // 2. Custom Cursor & Magnetic effect
    const cursor = document.getElementById("custom-cursor");
    const follower = document.getElementById("custom-cursor-follower");
    if (cursor && follower) {
        // Hide native cursor only if custom cursor is present
        document.body.style.cursor = "none";
        let links = document.querySelectorAll('a, button, input[type="text"], input[type="submit"], textarea');
        links.forEach(el => el.style.cursor = "none");
        window.mouseTrackerX = window.innerWidth / 2;
        window.mouseTrackerY = window.innerHeight / 2;
        let cPosX = window.mouseTrackerX, cPosY = window.mouseTrackerY;
        let fPosX = window.mouseTrackerX, fPosY = window.mouseTrackerY;

        // Mouse motion tracker 
        document.addEventListener("mousemove", (e) => {
            window.mouseTrackerX = e.clientX;
            window.mouseTrackerY = e.clientY;
        });

        // Ticker loop for smooth damping
        gsap.ticker.add(() => {
            cPosX += (window.mouseTrackerX - cPosX) * 0.3; // fast follow
            cPosY += (window.mouseTrackerY - cPosY) * 0.3;
            
            fPosX += (window.mouseTrackerX - fPosX) * 0.1; // slow follow
            fPosY += (window.mouseTrackerY - fPosY) * 0.1;

            gsap.set(cursor, { left: cPosX, top: cPosY });
            gsap.set(follower, { left: fPosX, top: fPosY });
        });

        // Optimal Hover effects (Scale instead of Magnetic tracking)
        const interactableElements = document.querySelectorAll(".gsap-magnetic, a, button, .gsap-draggable-card");
        interactableElements.forEach(el => {
            el.addEventListener("mouseenter", () => {
                // Simple scale up is much more performant than mouse-tracking parallax
                gsap.to(el, { scale: 1.05, duration: 0.3, ease: "power2.out" });

                // Visual feedback for the custom cursor
                gsap.to(follower, { scale: 1.5, borderColor: "#ec4899", borderWidth: 3, duration: 0.2 });
                gsap.to(cursor, { scale: 0.5, backgroundColor: "#ec4899", duration: 0.2 });
            });

            el.addEventListener("mouseleave", () => {
                gsap.to(el, { scale: 1, duration: 0.3, ease: "power2.out" });
                
                // Reset custom cursor
                gsap.to(follower, { scale: 1, borderColor: "#6366f1", borderWidth: 2, duration: 0.2 });
                gsap.to(cursor, { scale: 1, backgroundColor: "#ec4899", duration: 0.2 }); 
            });
        });


    }

    // 3. ScrollTrigger Madness
    // Apply huge dramatic animations as elements scroll into view
    const staggerCards = gsap.utils.toArray(".gsap-stagger-card");
    staggerCards.forEach(card => {
        gsap.from(card, {
            scrollTrigger: {
                trigger: card,
                start: "top 90%", // animate earlier
                toggleActions: "play none none reverse", 
            },
            y: 40,
            rotationX: 15, // lighter flip effect
            scale: 0.95,
            opacity: 0,
            duration: 0.5, // much faster
            ease: "power2.out"
        });
    });

    // We can also animate the floating elements continuously
    const floatingElements = document.querySelectorAll(".gsap-floating-element");
    floatingElements.forEach((el, index) => {
        gsap.to(el, {
            y: "-=30",
            x: "+=20",
            rotation: "+=25",
            duration: 4 + (Math.random() * 2),
            ease: "sine.inOut",
            yoyo: true,
            repeat: -1,
            delay: index * 0.2
        });
    });

    // 4. Squishy & Bouncing Buttons
    const squishyBtns = document.querySelectorAll(".gsap-squishy-btn");
    squishyBtns.forEach(btn => {
        btn.addEventListener("mousedown", () => {
            gsap.to(btn, { scale: 0.85, duration: 0.1, ease: "power1.inOut" });
        });
        
        btn.addEventListener("mouseup", () => {
            gsap.to(btn, { scale: 1, duration: 0.6, ease: "elastic.out(1.5, 0.3)" });
        });

        btn.addEventListener("mouseleave", () => {
            gsap.to(btn, { scale: 1, duration: 0.4 });
        });
    });

    // 5. Interactive Particle Network Background
    const canvas = document.getElementById("particle-canvas");
    if (canvas) {
        const ctx = canvas.getContext("2d");
        let width = canvas.width = window.innerWidth;
        let height = canvas.height = window.innerHeight;

        window.addEventListener('resize', () => {
            width = canvas.width = window.innerWidth;
            height = canvas.height = window.innerHeight;
            initParticles();
        });

        const particles = [];
        const properties = {
            particleCount: 50, // Minimalist (Reduced from 150)
            particleSpeed: 0.25, // Very slow and calm (Reduced from 0.8)
            mouseRepelRadius: 150
        };

        // Cake icing/sprinkle colors
        const colors = ['#f472b6', '#c084fc', '#818cf8', '#facc15', '#34d399', '#f87171', '#fb923c', '#2dd4bf']; 

        class Particle {
            constructor() {
                this.x = Math.random() * width;
                this.y = Math.random() * height;
                this.velocityX = Math.random() * (properties.particleSpeed * 2) - properties.particleSpeed;
                this.velocityY = Math.random() * (properties.particleSpeed * 2) - properties.particleSpeed;
                this.color = colors[Math.floor(Math.random() * colors.length)];
                
                // Sprinkle shape properties
                this.w = Math.random() * 4 + 4; // 4-8px width
                this.h = Math.random() * 12 + 10; // 10-22px length
                this.angle = Math.random() * Math.PI * 2;
                this.spin = (Math.random() - 0.5) * 0.02; // very slow natural spin
            }
            position() {
                // Wrap around logic
                if (this.x + this.velocityX > width && this.velocityX > 0 || this.x + this.velocityX < 0 && this.velocityX < 0) this.velocityX *= -1;
                if (this.y + this.velocityY > height && this.velocityY > 0 || this.y + this.velocityY < 0 && this.velocityY < 0) this.velocityY *= -1;
                
                // Mouse interactive force (Sprinkles scatter softly)
                const mx = window.mouseTrackerX || window.innerWidth / 2;
                const my = window.mouseTrackerY || window.innerHeight / 2;
                
                const dx = mx - this.x;
                const dy = my - this.y;
                const dist = Math.sqrt(dx * dx + dy * dy);

                // Gentle scatter when mouse gets close
                if (dist < properties.mouseRepelRadius) {
                    this.x -= dx * 0.015; // Soft repel
                    this.y -= dy * 0.015; // Soft repel
                    this.angle += 0.05; // Gentle spin
                }

                this.x += this.velocityX;
                this.y += this.velocityY;
                this.angle += this.spin; // apply constant natural spin
            }
            reDraw() {
                ctx.save();
                ctx.translate(this.x, this.y);
                ctx.rotate(this.angle);
                ctx.fillStyle = this.color;
                
                // Draw pill (sprinkle) shape safely
                ctx.beginPath();
                ctx.arc(0, -this.h/2 + this.w/2, this.w/2, Math.PI, 0); // top half circle
                ctx.lineTo(this.w/2, this.h/2 - this.w/2);
                ctx.arc(0, this.h/2 - this.w/2, this.w/2, 0, Math.PI); // bottom half circle
                ctx.closePath();
                ctx.fill();
                
                ctx.restore();
            }
        }

        function initParticles() {
            particles.length = 0;
            for (let i = 0; i < properties.particleCount; i++) {
                particles.push(new Particle);
            }
        }

        function loop() {
            ctx.clearRect(0, 0, width, height);
            for (let i = 0; i < properties.particleCount; i++) {
                particles[i].position();
                particles[i].reDraw();
            }
            requestAnimationFrame(loop);
        }

        initParticles();
        loop();
    }

    // 6. Hero Text Reveal Animation
    const heroLines = gsap.utils.toArray(".gsap-hero-line");
    if (heroLines.length > 0) {
        // Dramatic text reveal
        gsap.to(heroLines, {
            y: 0,
            opacity: 1,
            duration: 1.2,
            stagger: 0.15,
            ease: "expo.out",
            delay: 0.2 // Wait a bit after load
        });

        // Wiggle the cake emoji 
        gsap.fromTo(".gsap-cake-emoji", 
            { rotation: -45, scale: 0.2 },
            { 
                rotation: 0, 
                scale: 1, 
                duration: 1.2, 
                ease: "elastic.out(1.2, 0.4)", 
                delay: 0.6 
            }
        );

        // Fade up the paragraph and buttons
        gsap.to(".gsap-hero-fade", {
            y: 0,
            opacity: 1,
            duration: 1,
            stagger: 0.2,
            ease: "power3.out",
            delay: 0.7
        });
    }

    // 7. Draggable & Floating Cards on Landing Page
    const dragWrappers = document.querySelectorAll(".gsap-draggable-card");
    const floatingCards = document.querySelectorAll(".gsap-floating-card");

    if (dragWrappers.length > 0) {
        // A. Floating animation loop independently applied to the inner content
        floatingCards.forEach((card, i) => {
            gsap.to(card, {
                y: -15, 
                rotation: i % 2 === 0 ? 1.5 : -1.5,
                duration: 2 + (i * 0.2),
                yoyo: true,
                repeat: -1,
                ease: "sine.inOut"
            });
        });

        // B. Make the outer wrapper draggable around the whole screen
        Draggable.create(".gsap-draggable-card", {
            type: "x,y",
            edgeResistance: 0.65,
            bounds: document.body, // restrict dragging slightly so they stay in DOM bounds mostly
            onDragStart: function() {
                // scale up to show it's grabbed
                gsap.to(this.target, { scale: 1.08, rotation: 5, duration: 0.2, overwrite: "auto" });
                this.target.style.zIndex = "999"; 
            },
            onDragEnd: function() {
                // Return to normal
                gsap.to(this.target, { scale: 1, rotation: 0, duration: 0.5, ease: "back.out(1.5)" });
                this.target.style.zIndex = "";
            }
        });
    }
});
