const firstTl = gsap.timeline({
  scrollTrigger: {
    scrub: 1,
    pin: true,
    trigger: ".whoam",
    start: "top top",
    end: "bottom",
  },
});

firstTl
  .from(".whoam__title", { scale: 0, opacity: 0, y: 10, duration: 5 })
  .to(".whoam__word", {
    display: "initial",
    stagger: {
      each: 5,
      from: "top",
    },
  });

const secondTl = gsap.timeline({
  scrollTrigger: {
    trigger: ".vision",
    pin: true,
    start: "top top",
    end: "bottom top",
    scrub: 1,
    ease: "linear",
    pinSpacing: false,
  },
});

secondTl.to(".vision__item .vision__content", {
  height: 0,
  scale: 0.8,
  opacity: 0,
  stagger: 0.7,
  paddingTop: 0,
  paddingBottom: 0,
  display: "none",
});

secondTl.to(
  ".vision__item",
  {
    marginBottom: 10,
    stagger: 0.7,
  },
  "<"
);

const thirdTl = gsap.timeline({
  scrollTrigger: {
    trigger: ".projects",
    start: "120% 70%",
    end: "300% bottom",
    scrub: true,
  },
});

thirdTl
  .to(".blob", {
    height: "70svh",
    width: "100vw",
    borderRadius: "0%",
  })
  .from(".projects__title", { autoAlpha: 0, y: 30 });

const skewSetter = gsap.quickSetter(".p__item", "skewY", "deg");
const proxy = { skew: 0 };

ScrollTrigger.create({
  onUpdate: (self) => {
    let skew = self.getVelocity() / -400;

    if (Math.abs(skew) > Math.abs(proxy.skew)) {
      proxy.skew = skew;
      gsap.to(proxy, {
        skew: 0,
        duration: 1,
        ease: "power3",
        overwrite: true,
        onUpdate: () => {
          skewSetter(proxy.skew);
        },
      });
    }
  },
});

let forthTl = gsap.timeline({
  scrollTrigger: {
    trigger: ".projects__wrapper",
    start: "0% 50%",
    end: "11%",
    scrub: true,
    // markers: true,
  },
});

forthTl.from(".projects__wrapper", { autoAlpha: 0 });

const lenis = new Lenis();

lenis.on("scroll", (e) => {
  console.log(e);
});

function raf(time) {
  lenis.raf(time);
  requestAnimationFrame(raf);
}

requestAnimationFrame(raf);

const lenisst = new Lenis();

lenisst.on("scroll", ScrollTrigger.update);

gsap.ticker.add((time) => {
  lenis.raf(time * 1000);
});

gsap.ticker.lagSmoothing(0);
