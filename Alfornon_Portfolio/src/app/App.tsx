import { useState, useEffect, useRef } from "react";
import {
  motion,
  useScroll,
  useTransform,
  useInView,
} from "motion/react";
import {
  Github,
  Linkedin,
  Mail,
  Menu,
  X,
  ExternalLink,
  Award,
  Code2,
  Database,
  Globe,
  Smartphone,
  Terminal,
  Palette,
  Sparkles,
  Zap,
} from "lucide-react";
import { Footer } from "./components/Footer";
import heroImage from "../imports/Me.png";
import Logo from "../imports/Ms.Jhai.png";

export default function App() {
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
  const [activeSection, setActiveSection] = useState("home");

  useEffect(() => {
    const handleScroll = () => {
      const sections = [
        "home",
        "about",
        "works",
        "skills",
        "certificates",
        "contact",
      ];
      const scrollPosition = window.scrollY + 100;

      for (const section of sections) {
        const element = document.getElementById(section);
        if (element) {
          const { offsetTop, offsetHeight } = element;
          if (
            scrollPosition >= offsetTop &&
            scrollPosition < offsetTop + offsetHeight
          ) {
            setActiveSection(section);
            break;
          }
        }
      }
    };

    window.addEventListener("scroll", handleScroll);
    return () =>
      window.removeEventListener("scroll", handleScroll);
  }, []);

  const scrollToSection = (id: string) => {
    const element = document.getElementById(id);
    if (element) {
      element.scrollIntoView({ behavior: "smooth" });
      setMobileMenuOpen(false);
    }
  };

  return (
    <div className="min-h-screen bg-white">
      {/* Navigation */}
      <Navigation
        activeSection={activeSection}
        scrollToSection={scrollToSection}
        mobileMenuOpen={mobileMenuOpen}
        setMobileMenuOpen={setMobileMenuOpen}
      />

      {/* Hero */}
      <Hero scrollToSection={scrollToSection} />

      {/* About */}
      <About />

      {/* Works */}
      <Works />

      {/* Skills */}
      <Skills />

      {/* Certificates */}
      <Certificates />

      {/* Contact */}
      <Contact />

      {/* Footer */}
      <Footer scrollToSection={scrollToSection} />
    </div>
  );
}

function Navigation({
  activeSection,
  scrollToSection,
  mobileMenuOpen,
  setMobileMenuOpen,
}: {
  activeSection: string;
  scrollToSection: (id: string) => void;
  mobileMenuOpen: boolean;
  setMobileMenuOpen: (open: boolean) => void;
}) {
  const navLinks = [
    { id: "home", label: "Home" },
    { id: "about", label: "About" },
    { id: "works", label: "Works" },
    { id: "skills", label: "Skills" },
    { id: "certificates", label: "Certificates" },
    { id: "contact", label: "Contact" },
  ];

  return (
    <motion.nav
      initial={{ y: -100 }}
      animate={{ y: 0 }}
      className="fixed top-0 left-0 right-0 z-50 bg-white/70 backdrop-blur-2xl border-b border-[#A3554F]/10"
      style={{ boxShadow: "0 4px 30px rgba(163, 85, 79, 0.1)" }}
    >
      <div className="max-w-7xl mx-auto px-6 py-4">
        <div className="flex items-center justify-between">
          <motion.div
            initial={{ opacity: 0, x: -20 }}
            animate={{ opacity: 1, x: 0 }}
            transition={{ delay: 0.2 }}
            className="text-2xl font-bold text-[#A3554F] flex items-center gap-2"
          >
           <div className="w-10 h-10 rounded-lg flex items-center justify-center overflow-visible">
              <img
                src={Logo}
                alt="Logo"
                className="w-20 h-20 object-contain cursor-pointer scale-220"
                onClick={() => scrollToSection("home")}
              />
            </div>
          </motion.div>

          {/* Desktop Navigation */}
          <div className="hidden md:flex items-center gap-8">
            {navLinks.map((link, index) => (
              <motion.button
                key={link.id}
                initial={{ opacity: 0, y: -20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: 0.1 * index }}
                onClick={() => scrollToSection(link.id)}
                className={`relative text-sm font-medium transition-colors ${
                  activeSection === link.id
                    ? "text-[#A3554F]"
                    : "text-[#6A8284] hover:text-[#A3554F]"
                }`}
              >
                {link.label}
                {activeSection === link.id && (
                  <motion.div
                    layoutId="activeSection"
                    className="absolute -bottom-1 left-0 right-0 h-0.5 bg-gradient-to-r from-[#A3554F] to-[#C1705A] rounded-full"
                  />
                )}
              </motion.button>
            ))}
          </div>

          {/* Mobile Menu Button */}
          <button
            onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
            className="md:hidden text-[#6A8284] p-2 hover:text-[#A3554F] transition-colors"
          >
            {mobileMenuOpen ? (
              <X size={24} />
            ) : (
              <Menu size={24} />
            )}
          </button>
        </div>

        {/* Mobile Menu */}
        {mobileMenuOpen && (
          <motion.div
            initial={{ opacity: 0, height: 0 }}
            animate={{ opacity: 1, height: "auto" }}
            exit={{ opacity: 0, height: 0 }}
            className="md:hidden mt-4 pb-4 flex flex-col gap-4"
          >
            {navLinks.map((link) => (
              <button
                key={link.id}
                onClick={() => scrollToSection(link.id)}
                className={`text-left text-sm font-medium transition-colors ${
                  activeSection === link.id
                    ? "text-[#A3554F]"
                    : "text-[#6A8284]"
                }`}
              >
                {link.label}
              </button>
            ))}
          </motion.div>
        )}
      </div>
    </motion.nav>
  );
}

function Hero({
  scrollToSection,
}: {
  scrollToSection: (id: string) => void;
}) {
  const { scrollY } = useScroll();
  const opacity = useTransform(scrollY, [0, 500], [1, 0]);
  const scale = useTransform(scrollY, [0, 500], [1, 0.9]);

  return (
    <section
      id="home"
      className="relative min-h-screen flex items-center justify-center overflow-hidden"
    >
      {/* Background Image */}
      <div className="absolute inset-0">
        <img
          src={heroImage}
          alt="Hero Background"
          className="w-full h-full object-cover"
        />
        {/* Overlay for better text readability */}
        <div className="absolute inset-0 bg-gradient-to-br from-black/20 via-transparent to-black/30" />
      </div>

      {/* Content - Positioned at bottom left */}
      <motion.div
        style={{ opacity, scale }}
        className="absolute bottom-20 left-45 z-10"
      >
        <motion.div
          initial={{ opacity: 0, y: 30 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.8, delay: 0.2 }}
          className="flex flex-col sm:flex-row gap-3"
        >
          <motion.button
            whileHover={{
              scale: 1.05,
              boxShadow: "0 15px 35px rgba(163, 85, 79, 0.4)",
            }}
            whileTap={{ scale: 0.98 }}
            onClick={() => scrollToSection("works")}
            className="px-6 py-3 bg-gradient-to-r from-[#A3554F] to-[#C1705A] text-white rounded-xl font-medium shadow-xl shadow-[#A3554F]/30 transition-all text-sm"
          >
            Explore My Work
          </motion.button>
          <motion.button
            whileHover={{ scale: 1.05 }}
            whileTap={{ scale: 0.98 }}
            onClick={() => scrollToSection("contact")}
            className="px-6 py-3 bg-white/90 backdrop-blur-md text-[#A3554F] border-2 border-white rounded-xl font-medium hover:bg-white hover:text-[#6A8284] transition-all shadow-lg text-sm"
          >
            Let's Connect
          </motion.button>
        </motion.div>
      </motion.div>

      {/* Scroll Indicator */}
      <motion.div
        initial={{ opacity: 0 }}
        animate={{ opacity: 1 }}
        transition={{ delay: 1.2 }}
        className="absolute bottom-12 left-1/2 -translate-x-1/2"
      >
        <motion.div
          animate={{ y: [0, 15, 0] }}
          transition={{ duration: 2, repeat: Infinity }}
        ></motion.div>
      </motion.div>
    </section>
  );
}

function About() {
  const ref = useRef(null);
  const isInView = useInView(ref, { once: true, amount: 0.3 });

  return (
    <section
      id="about"
      className="relative pt-5 pb-10 px-6 bg-white overflow-hidden"
      ref={ref}
    >
      {/* Wave Divider Top */}
      <div className="absolute top-0 left-0 right-0 overflow-hidden leading-[0]">
        <svg
          className="relative block w-full h-30"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 1200 120"
          preserveAspectRatio="none"
        >
          <path
            d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
            className="fill-[#FFD6A9]"
          ></path>
        </svg>
      </div>

      {/* Background Blob */}
      <div className="absolute top-20 right-0 w-[250px] h-[250px] bg-gradient-to-br from-[#FFD6A9]/30 to-[#E4B192]/30 rounded-full blur-3xl" />

      <div className="max-w-6xl mx-auto relative z-10">
        <motion.div
          initial={{ opacity: 0, y: 50 }}
          animate={isInView ? { opacity: 1, y: 0 } : {}}
          transition={{ duration: 0.6 }}
          className="text-center mb-20"
        >
          <motion.div
            initial={{ opacity: 0, scale: 0.8 }}
            animate={isInView ? { opacity: 1, scale: 1 } : {}}
            transition={{ duration: 0.5 }}
            className="inline-block mb-4"
          ></motion.div>
          <h2 className="text-5xl md:text-7xl font-bold text-[#6A8284] mb-4">
            About Me
          </h2>
          <div className="w-32 h-2 bg-gradient-to-r from-[#A3554F] via-[#C1705A] to-transparent mx-auto rounded-full" />
        </motion.div>

        <div className="grid md:grid-cols-2 gap-16 items-center">
          <motion.div
            initial={{ opacity: 0, x: -80 }}
            animate={isInView ? { opacity: 1, x: 0 } : {}}
            transition={{ duration: 0.8, delay: 0.2 }}
            className="relative"
          >
            {/* Layered Background Cards */}
            <div className="absolute inset-0 bg-gradient-to-br from-[#A3554F] to-[#C1705A] rounded-[3rem] transform rotate-6 opacity-20" />
            <div className="absolute inset-0 bg-gradient-to-br from-[#C1705A] to-[#E4B192] rounded-[3rem] transform rotate-3 opacity-30" />

            {/* Main Card */}
            <div className="relative bg-gradient-to-br from-[#E4B192] to-[#FFD6A9] rounded-[3rem] p-12 shadow-2xl">
              <div className="flex flex-col items-center">
                {/* Creative Profile Circle */}
                <div className="relative mb-8">
                  <motion.div
                    animate={{
                      rotate: 360,
                    }}
                    transition={{
                      duration: 20,
                      repeat: Infinity,
                      ease: "linear",
                    }}
                    className="absolute inset-0 bg-gradient-to-r from-[#A3554F] to-[#C1705A] rounded-full blur-xl opacity-25"
                  />
                  <div className="relative w-56 h-56 bg-white rounded-full flex items-center justify-center shadow-2xl">
                    <div className="text-[#A3554F] text-7xl font-bold">
                      JA
                    </div>
                  </div>
                </div>

                {/* Floating Tech Icons */}
                <div className="flex gap-4">
                  {[Code2, Database, Globe].map((Icon, i) => (
                    <motion.div
                      key={i}
                      animate={{
                        y: [0, -10, 0],
                      }}
                      transition={{
                        duration: 2 + i * 0.5,
                        repeat: Infinity,
                        ease: "easeInOut",
                        delay: i * 0.2,
                      }}
                      className="w-16 h-16 bg-white/60 backdrop-blur-md rounded-2xl flex items-center justify-center shadow-lg"
                    >
                      <Icon
                        className="text-[#A3554F]"
                        size={28}
                      />
                    </motion.div>
                  ))}
                </div>
              </div>
            </div>

            {/* Decorative Dots */}
            <div className="absolute -bottom-4 -right-4 w-24 h-24 grid grid-cols-4 gap-2">
              {[...Array(16)].map((_, i) => (
                <div
                  key={i}
                  className="w-2 h-2 bg-[#A3554F]/20 rounded-full"
                />
              ))}
            </div>
          </motion.div>

          <motion.div
            initial={{ opacity: 0, x: 80 }}
            animate={isInView ? { opacity: 1, x: 0 } : {}}
            transition={{ duration: 0.8, delay: 0.4 }}
            className="space-y-8"
          >
            <div>
              <h3 className="text-4xl font-bold text-[#A3554F] mb-6">
                Creative Problem Solver
              </h3>
              <div className="space-y-5 text-lg text-[#6A8284] leading-relaxed">
                <p>
                  I'm a passionate IT student specializing in
                  full-stack development with a keen eye for
                  design. I believe that great software is where
                  functionality meets beautiful user experience.
                </p>
                <p>
                  My journey in tech has equipped me with
                  diverse skills across modern frameworks,
                  databases, and cloud technologies. I thrive on
                  turning complex problems into elegant
                  solutions.
                </p>
                <p>
                  When I'm not coding, you'll find me exploring
                  new design trends, contributing to open-source
                  projects, or mentoring fellow students in the
                  developer community.
                </p>
              </div>
            </div>

            {/* Stats Cards */}
            <div className="grid grid-cols-3 gap-4 pt-6">
              {[
                {
                  num: "15+",
                  label: "Projects",
                  color: "from-[#A3554F] to-[#C1705A]",
                },
                {
                  num: "8+",
                  label: "Certificates",
                  color: "from-[#C1705A] to-[#E4B192]",
                },
                {
                  num: "3+",
                  label: "Years",
                  color: "from-[#9EB2B1] to-[#6A8284]",
                },
              ].map((stat, i) => (
                <motion.div
                  key={i}
                  initial={{ opacity: 0, y: 20 }}
                  animate={isInView ? { opacity: 1, y: 0 } : {}}
                  transition={{ delay: 0.6 + i * 0.1 }}
                  whileHover={{ scale: 1.05, y: -5 }}
                  className={`bg-gradient-to-br ${stat.color} rounded-2xl p-5 text-center shadow-lg`}
                >
                  <div className="text-3xl font-bold text-white mb-1">
                    {stat.num}
                  </div>
                  <div className="text-sm text-white/90">
                    {stat.label}
                  </div>
                </motion.div>
              ))}
            </div>
          </motion.div>
        </div>
      </div>
    </section>
  );
}

function Works() {
  const ref = useRef(null);
  const isInView = useInView(ref, { once: true, amount: 0.2 });

  const projects = [
    {
      title: "E-Commerce Platform",
      description:
        "Full-stack online marketplace with payment integration, real-time inventory, and advanced analytics.",
      tech: ["React", "Node.js", "MongoDB"],
      gradient: "from-[#A3554F] to-[#C1705A]",
      rotate: "rotate-2",
    },
    {
      title: "Task Management Suite",
      description:
        "Collaborative project tool with real-time updates, kanban boards, and team collaboration features.",
      tech: ["Vue.js", "Firebase", "Tailwind"],
      gradient: "from-[#C1705A] to-[#E4B192]",
      rotate: "-rotate-1",
    },
    {
      title: "Weather Analytics Dashboard",
      description:
        "Data visualization platform with interactive forecasts, historical data, and location services.",
      tech: ["React", "D3.js", "API Integration"],
      gradient: "from-[#E4B192] to-[#FFD6A9]",
      rotate: "rotate-1",
    },
    {
      title: "Creative Portfolio CMS",
      description:
        "Headless CMS designed for artists and designers to showcase work with custom layouts.",
      tech: ["Next.js", "Sanity", "TypeScript"],
      gradient: "from-[#9EB2B1] to-[#6A8284]",
      rotate: "-rotate-2",
    },
    {
      title: "Fitness Companion App",
      description:
        "Mobile-first application for workout tracking, nutrition planning, and progress analytics.",
      tech: ["React Native", "Express", "PostgreSQL"],
      gradient: "from-[#A3554F] to-[#9EB2B1]",
      rotate: "rotate-1",
    },
    {
      title: "Real-Time Chat Platform",
      description:
        "Messaging application with group chats, file sharing, video calls, and notifications.",
      tech: ["Socket.io", "React", "Redis"],
      gradient: "from-[#C1705A] to-[#A3554F]",
      rotate: "-rotate-1",
    },
  ];

  return (
    <section
      id="works"
      className="relative pt-40 pb-32 px-6 overflow-hidden"
      ref={ref}
    >
      {/* Gradient Background */}
      <div className="absolute inset-0 bg-gradient-to-br from-[#FFD6A9]/30 via-white to-[#E4B192]/20" />

      {/* Abstract Shapes */}
      <div className="absolute top-20 left-0 w-96 h-96 bg-gradient-to-br from-[#A3554F]/10 to-transparent rounded-full blur-3xl" />
      <div className="absolute bottom-20 right-0 w-96 h-96 bg-gradient-to-tl from-[#9EB2B1]/10 to-transparent rounded-full blur-3xl" />

      <div className="max-w-7xl mx-auto relative z-10">
        <motion.div
          initial={{ opacity: 0, y: 50 }}
          animate={isInView ? { opacity: 1, y: 0 } : {}}
          transition={{ duration: 0.6 }}
          className="text-center mb-20"
        >
          <motion.div
            initial={{ opacity: 0, scale: 0.8 }}
            animate={isInView ? { opacity: 1, scale: 1 } : {}}
            transition={{ duration: 0.5 }}
            className="inline-block mb-4"
          ></motion.div>
          <h2 className="text-5xl md:text-7xl font-bold text-[#6A8284] mb-6">
            Featured Works
          </h2>
          <div className="w-32 h-2 bg-gradient-to-r from-[#A3554F] via-[#C1705A] to-transparent mx-auto rounded-full mb-6" />
          <p className="text-[#9EB2B1] text-lg max-w-2xl mx-auto">
            A showcase of innovative projects blending
            creativity with technical excellence
          </p>
        </motion.div>

        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
          {projects.map((project, index) => (
            <motion.div
              key={index}
              initial={{ opacity: 0, y: 60, rotate: 0 }}
              animate={isInView ? { opacity: 1, y: 0 } : {}}
              transition={{
                duration: 0.7,
                delay: index * 0.15,
              }}
              whileHover={{ y: -15, rotate: 0 }}
              className={`group relative ${project.rotate}`}
            >
              {/* Glow Effect */}
              <div
                className={`absolute -inset-2 bg-gradient-to-r ${project.gradient} rounded-3xl opacity-0 group-hover:opacity-20 blur-xl transition-opacity duration-500`}
              />

              {/* Card */}
              <div className="relative bg-white rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500">
                {/* Project Visual */}
                <div
                  className={`h-64 bg-gradient-to-br ${project.gradient} relative overflow-hidden`}
                >
                  {/* Overlay Pattern */}
                  <div className="absolute inset-0 opacity-10">
                    <div
                      className="absolute top-0 left-0 w-full h-full"
                      style={{
                        backgroundImage:
                          "radial-gradient(circle, white 1px, transparent 1px)",
                        backgroundSize: "20px 20px",
                      }}
                    />
                  </div>

                  {/* Icon */}
                  <motion.div
                    initial={{ scale: 1, rotate: 0 }}
                    whileHover={{ scale: 1.1, rotate: 5 }}
                    transition={{ duration: 0.3 }}
                    className="absolute inset-0 flex items-center justify-center"
                  >
                    <Code2
                      className="text-white/80"
                      size={90}
                    />
                  </motion.div>

                  {/* Hover Overlay */}
                  <motion.div
                    initial={{ opacity: 0, y: 20 }}
                    whileHover={{ opacity: 1, y: 0 }}
                    className="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent flex items-end justify-center pb-8"
                  >
                    <button className="px-6 py-3 bg-white/90 backdrop-blur-md text-[#A3554F] rounded-xl font-bold flex items-center gap-2 shadow-lg hover:bg-white transition-all">
                      View Project
                      <ExternalLink size={18} />
                    </button>
                  </motion.div>
                </div>

                {/* Content */}
                <div className="p-7">
                  <h3 className="text-2xl font-bold text-[#6A8284] mb-3 group-hover:text-[#A3554F] transition-colors">
                    {project.title}
                  </h3>
                  <p className="text-[#9EB2B1] mb-5 text-sm leading-relaxed">
                    {project.description}
                  </p>
                  <div className="flex flex-wrap gap-2">
                    {project.tech.map((tech, i) => (
                      <span
                        key={i}
                        className="px-4 py-2 bg-gradient-to-r from-[#FFD6A9] to-[#E4B192] text-[#A3554F] text-xs font-bold rounded-xl shadow-sm"
                      >
                        {tech}
                      </span>
                    ))}
                  </div>
                </div>

                {/* Corner Element */}
                <div className="absolute top-4 right-4 w-14 h-14 border-3 border-white/50 rounded-xl rotate-12 group-hover:rotate-45 transition-transform duration-300" />
              </div>
            </motion.div>
          ))}
        </div>
      </div>

      {/* Wave Divider Bottom */}
      <div className="absolute bottom-0 left-0 right-0 overflow-hidden leading-[0] rotate-180">
        <svg
          className="relative block w-full h-32"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 1200 120"
          preserveAspectRatio="none"
        >
          <path
            d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
            className="fill-white"
          ></path>
        </svg>
      </div>
    </section>
  );
}

function Skills() {
  const ref = useRef(null);
  const isInView = useInView(ref, { once: true, amount: 0.3 });

  const skills = [
    {
      name: "Frontend Development",
      level: 92,
      icon: Globe,
      color: "from-[#A3554F] to-[#C1705A]",
    },
    {
      name: "Backend Development",
      level: 88,
      icon: Database,
      color: "from-[#C1705A] to-[#E4B192]",
    },
    {
      name: "Mobile Development",
      level: 78,
      icon: Smartphone,
      color: "from-[#E4B192] to-[#FFD6A9]",
    },
    {
      name: "UI/UX Design",
      level: 85,
      icon: Palette,
      color: "from-[#9EB2B1] to-[#6A8284]",
    },
    {
      name: "Database Management",
      level: 87,
      icon: Terminal,
      color: "from-[#A3554F] to-[#9EB2B1]",
    },
    {
      name: "DevOps & Cloud",
      level: 75,
      icon: Code2,
      color: "from-[#C1705A] to-[#A3554F]",
    },
  ];

  return (
    <section
      id="skills"
      className="relative pt-40 pb-32 px-6 bg-white overflow-hidden"
      ref={ref}
    >
      {/* Background Elements */}
      <div className="absolute top-0 left-0 w-[500px] h-[500px] bg-gradient-to-br from-[#E4B192]/20 to-transparent rounded-full blur-3xl" />
      <div className="absolute bottom-0 right-0 w-[600px] h-[600px] bg-gradient-to-tl from-[#FFD6A9]/30 to-transparent rounded-full blur-3xl" />

      <div className="max-w-6xl mx-auto relative z-10">
        <motion.div
          initial={{ opacity: 0, y: 50 }}
          animate={isInView ? { opacity: 1, y: 0 } : {}}
          transition={{ duration: 0.6 }}
          className="text-center mb-20"
        >
          <motion.div
            initial={{ opacity: 0, scale: 0.8 }}
            animate={isInView ? { opacity: 1, scale: 1 } : {}}
            transition={{ duration: 0.5 }}
            className="inline-block mb-4"
          ></motion.div>
          <h2 className="text-5xl md:text-7xl font-bold text-[#6A8284] mb-4">
            Skills & Expertise
          </h2>
          <div className="w-32 h-2 bg-gradient-to-r from-[#A3554F] via-[#C1705A] to-transparent mx-auto rounded-full" />
        </motion.div>

        <div className="grid md:grid-cols-2 gap-12">
          {skills.map((skill, index) => {
            const Icon = skill.icon;
            return (
              <motion.div
                key={index}
                initial={{
                  opacity: 0,
                  x: index % 2 === 0 ? -80 : 80,
                }}
                animate={isInView ? { opacity: 1, x: 0 } : {}}
                transition={{
                  duration: 0.7,
                  delay: index * 0.1,
                }}
                className="relative"
              >
                {/* Glassmorphic Card */}
                <div className="bg-white/60 backdrop-blur-md rounded-3xl p-8 shadow-xl border border-[#E4B192]/30 hover:shadow-2xl transition-all duration-300">
                  <div className="flex items-center gap-5 mb-6">
                    <motion.div
                      whileHover={{ scale: 1.1, rotate: 10 }}
                      transition={{
                        type: "spring",
                        stiffness: 300,
                      }}
                      className={`w-16 h-16 bg-gradient-to-br ${skill.color} rounded-2xl flex items-center justify-center shadow-xl`}
                    >
                      <Icon className="text-white" size={28} />
                    </motion.div>
                    <div className="flex-1">
                      <h4 className="text-xl font-bold text-[#6A8284] mb-2">
                        {skill.name}
                      </h4>
                      <div className="flex items-center justify-between">
                        <span className="text-sm font-bold text-[#A3554F]">
                          {skill.level}%
                        </span>
                      </div>
                    </div>
                  </div>

                  {/* Progress Bar */}
                  <div className="relative h-4 bg-gradient-to-r from-[#FFD6A9]/50 to-[#E4B192]/30 rounded-full overflow-hidden shadow-inner">
                    <motion.div
                      initial={{ width: 0 }}
                      animate={
                        isInView
                          ? { width: `${skill.level}%` }
                          : {}
                      }
                      transition={{
                        duration: 1.5,
                        delay: index * 0.15 + 0.3,
                        ease: "easeOut",
                      }}
                      className={`absolute top-0 left-0 h-full bg-gradient-to-r ${skill.color} rounded-full shadow-lg relative overflow-hidden`}
                    >
                      {/* Shine Effect */}
                      <motion.div
                        animate={{ x: ["-100%", "200%"] }}
                        transition={{
                          duration: 2,
                          repeat: Infinity,
                          delay: 1,
                        }}
                        className="absolute inset-0 bg-gradient-to-r from-transparent via-white/30 to-transparent"
                      />
                    </motion.div>
                  </div>
                </div>
              </motion.div>
            );
          })}
        </div>

        {/* Tech Stack Section */}
        <motion.div
          initial={{ opacity: 0, y: 40 }}
          animate={isInView ? { opacity: 1, y: 0 } : {}}
          transition={{ duration: 0.8, delay: 0.8 }}
          className="mt-28"
        >
          <h3 className="text-3xl font-bold text-[#6A8284] text-center mb-10">
            Tech Stack
          </h3>
          <div className="flex flex-wrap justify-center gap-4">
            {[
              "React",
              "Node.js",
              "TypeScript",
              "Python",
              "PostgreSQL",
              "MongoDB",
              "AWS",
              "Docker",
              "Git",
              "Figma",
            ].map((tech, i) => (
              <motion.div
                key={i}
                initial={{
                  opacity: 0,
                  scale: 0.5,
                  rotate: -10,
                }}
                animate={
                  isInView
                    ? { opacity: 1, scale: 1, rotate: 0 }
                    : {}
                }
                transition={{
                  delay: 0.9 + i * 0.05,
                  type: "spring",
                }}
                whileHover={{ scale: 1.15, y: -8, rotate: 5 }}
                className="relative group"
              >
                {/* Glow */}
                <div className="absolute -inset-1 bg-gradient-to-r from-[#A3554F] to-[#C1705A] rounded-2xl opacity-0 group-hover:opacity-30 blur-lg transition-opacity" />

                {/* Badge */}
                <div className="relative px-6 py-3 bg-gradient-to-r from-[#FFD6A9] to-[#E4B192] rounded-2xl text-[#A3554F] font-bold shadow-lg">
                  {tech}
                </div>
              </motion.div>
            ))}
          </div>
        </motion.div>
      </div>
    </section>
  );
}

function Certificates() {
  const ref = useRef(null);
  const isInView = useInView(ref, { once: true, amount: 0.2 });

  const certificates = [
    {
      title: "Full Stack Web Development",
      issuer: "freeCodeCamp",
      year: "2024",
      gradient: "from-[#A3554F] to-[#C1705A]",
      rotation: -3,
    },
    {
      title: "AWS Cloud Practitioner",
      issuer: "Amazon Web Services",
      year: "2024",
      gradient: "from-[#C1705A] to-[#E4B192]",
      rotation: 2,
    },
    {
      title: "React Advanced Patterns",
      issuer: "Frontend Masters",
      year: "2023",
      gradient: "from-[#E4B192] to-[#FFD6A9]",
      rotation: -2,
    },
    {
      title: "MongoDB Developer",
      issuer: "MongoDB University",
      year: "2023",
      gradient: "from-[#9EB2B1] to-[#6A8284]",
      rotation: 3,
    },
    {
      title: "UI/UX Design Fundamentals",
      issuer: "Interaction Design Foundation",
      year: "2023",
      gradient: "from-[#A3554F] to-[#9EB2B1]",
      rotation: -2,
    },
    {
      title: "JavaScript Algorithms",
      issuer: "Coursera",
      year: "2022",
      gradient: "from-[#C1705A] to-[#A3554F]",
      rotation: 2,
    },
  ];

  return (
    <section
      id="certificates"
      className="relative pt-40 pb-32 px-6 overflow-hidden"
      ref={ref}
    >
      {/* Gradient Background */}
      <div className="absolute inset-0 bg-gradient-to-br from-[#FFD6A9]/20 via-[#E4B192]/10 to-white" />

      {/* Diagonal Divider */}
      <div className="absolute top-0 left-0 right-0 h-32 bg-gradient-to-br from-[#FFD6A9] to-[#E4B192] transform -skew-y-2 origin-top-left" />

      <div className="max-w-7xl mx-auto relative z-10">
        <motion.div
          initial={{ opacity: 0, y: 50 }}
          animate={isInView ? { opacity: 1, y: 0 } : {}}
          transition={{ duration: 0.6 }}
          className="text-center mb-20"
        >
          <motion.div
            initial={{ opacity: 0, scale: 0.8 }}
            animate={isInView ? { opacity: 1, scale: 1 } : {}}
            transition={{ duration: 0.5 }}
            className="inline-block mb-4"
          ></motion.div>
          <h2 className="text-5xl md:text-7xl font-bold text-[#6A8284] mb-6">
            Certificates & Awards
          </h2>
          <div className="w-32 h-2 bg-gradient-to-r from-[#A3554F] via-[#C1705A] to-transparent mx-auto rounded-full mb-6" />
          <p className="text-[#9EB2B1] text-lg max-w-2xl mx-auto">
            Continuous learning and professional development
            milestones
          </p>
        </motion.div>

        {/* Stacked/Layered Cards */}
        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          {certificates.map((cert, index) => (
            <motion.div
              key={index}
              initial={{
                opacity: 0,
                y: 60,
                rotate: cert.rotation,
              }}
              animate={isInView ? { opacity: 1, y: 0 } : {}}
              transition={{
                duration: 0.6,
                delay: index * 0.1,
                type: "spring",
              }}
              whileHover={{
                y: -15,
                rotate: 0,
                scale: 1.05,
              }}
              className="relative group cursor-pointer"
              style={{ transformOrigin: "center" }}
            >
              {/* Layered Background */}
              <div
                className={`absolute inset-0 bg-gradient-to-br ${cert.gradient} rounded-3xl transform rotate-3 opacity-20 group-hover:opacity-0 transition-opacity`}
              />
              <div
                className={`absolute inset-0 bg-gradient-to-br ${cert.gradient} rounded-3xl transform -rotate-2 opacity-10 group-hover:opacity-0 transition-opacity`}
              />

              {/* Glow Effect */}
              <div
                className={`absolute -inset-2 bg-gradient-to-br ${cert.gradient} rounded-3xl opacity-0 group-hover:opacity-30 blur-2xl transition-opacity duration-500`}
              />

              {/* Main Card */}
              <div className="relative bg-white rounded-3xl p-8 shadow-xl group-hover:shadow-2xl transition-all duration-500 border-2 border-transparent group-hover:border-[#E4B192]/30">
                {/* Header */}
                <div className="flex items-start justify-between mb-6">
                  <motion.div
                    whileHover={{ rotate: 360, scale: 1.1 }}
                    transition={{ duration: 0.6 }}
                    className={`w-20 h-20 bg-gradient-to-br ${cert.gradient} rounded-2xl flex items-center justify-center shadow-xl`}
                  >
                    <Award className="text-white" size={36} />
                  </motion.div>
                  <div className="px-4 py-2 bg-gradient-to-r from-[#FFD6A9] to-[#E4B192] rounded-full text-[#A3554F] text-sm font-bold shadow-md">
                    {cert.year}
                  </div>
                </div>

                {/* Content */}
                <h3 className="text-2xl font-bold text-[#6A8284] mb-3 group-hover:text-[#A3554F] transition-colors">
                  {cert.title}
                </h3>
                <p className="text-[#9EB2B1] font-medium text-lg mb-6">
                  {cert.issuer}
                </p>

                {/* Decorative Element */}
                <div className="flex gap-2">
                  {[...Array(5)].map((_, i) => (
                    <motion.div
                      key={i}
                      initial={{ width: 0 }}
                      animate={
                        isInView ? { width: "100%" } : {}
                      }
                      transition={{
                        delay: index * 0.1 + i * 0.05,
                        duration: 0.3,
                      }}
                      className={`h-1 bg-gradient-to-r ${cert.gradient} rounded-full`}
                    />
                  ))}
                </div>

                {/* Corner Decoration */}
                <div className="absolute bottom-5 right-5 w-20 h-20 border-3 border-[#E4B192]/30 rounded-2xl rotate-12 opacity-0 group-hover:opacity-100 group-hover:rotate-45 transition-all duration-300" />
              </div>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
}

function Contact() {
  const ref = useRef(null);
  const isInView = useInView(ref, { once: true, amount: 0.3 });

  return (
    <section
      id="contact"
      className="relative pt-40 pb-32 px-6 overflow-hidden"
      ref={ref}
    >
      {/* Gradient Background */}
      <div className="absolute inset-0 bg-gradient-to-br from-[#A3554F] via-[#C1705A] to-[#6A8284]" />

      {/* Abstract Blobs */}
      <motion.div
        animate={{
          scale: [1, 1.3, 1],
          rotate: [0, 180, 360],
          borderRadius: [
            "60% 40% 30% 70%",
            "30% 60% 70% 40%",
            "60% 40% 30% 70%",
          ],
        }}
        transition={{
          duration: 20,
          repeat: Infinity,
          ease: "easeInOut",
        }}
        className="absolute -top-40 -right-40 w-[800px] h-[800px] bg-gradient-to-br from-[#E4B192]/30 to-[#FFD6A9]/20 blur-3xl"
      />
      <motion.div
        animate={{
          scale: [1.2, 1, 1.2],
          rotate: [360, 180, 0],
          borderRadius: [
            "30% 70% 70% 30%",
            "70% 30% 30% 70%",
            "30% 70% 70% 30%",
          ],
        }}
        transition={{
          duration: 25,
          repeat: Infinity,
          ease: "easeInOut",
        }}
        className="absolute -bottom-40 -left-40 w-[700px] h-[700px] bg-gradient-to-tl from-[#9EB2B1]/20 to-transparent blur-3xl"
      />

      <div className="max-w-5xl mx-auto relative z-10">
        <motion.div
          initial={{ opacity: 0, y: 50 }}
          animate={isInView ? { opacity: 1, y: 0 } : {}}
          transition={{ duration: 0.6 }}
          className="text-center mb-16"
        >
          <motion.div
            initial={{ opacity: 0, scale: 0.8 }}
            animate={isInView ? { opacity: 1, scale: 1 } : {}}
            transition={{ duration: 0.5 }}
            className="inline-block mb-4"
          ></motion.div>
          <h2 className="text-5xl md:text-7xl font-bold text-white mb-6">
            Get In Touch
          </h2>
          <div className="w-32 h-2 bg-white/80 mx-auto rounded-full mb-6" />
          <p className="text-[#FFD6A9] text-lg max-w-2xl mx-auto">
            Have an exciting project or opportunity? Let's
            collaborate and create something extraordinary
            together.
          </p>
        </motion.div>

        <motion.div
          initial={{ opacity: 0, y: 50 }}
          animate={isInView ? { opacity: 1, y: 0 } : {}}
          transition={{ duration: 0.6, delay: 0.2 }}
          className="bg-white/10 backdrop-blur-2xl rounded-[3rem] p-12 mb-12 shadow-2xl border-2 border-white/20"
        >
          <form className="space-y-8">
            <div className="grid md:grid-cols-2 gap-8">
              <div>
                <label className="block text-white mb-3 text-sm font-bold">
                  Name
                </label>
                <input
                  type="text"
                  className="w-full px-6 py-4 bg-white/10 border-2 border-white/30 rounded-2xl text-white placeholder-white/60 focus:outline-none focus:border-[#FFD6A9] focus:bg-white/20 transition-all backdrop-blur-md"
                  placeholder="Your name"
                />
              </div>
              <div>
                <label className="block text-white mb-3 text-sm font-bold">
                  Email
                </label>
                <input
                  type="email"
                  className="w-full px-6 py-4 bg-white/10 border-2 border-white/30 rounded-2xl text-white placeholder-white/60 focus:outline-none focus:border-[#FFD6A9] focus:bg-white/20 transition-all backdrop-blur-md"
                  placeholder="your@email.com"
                />
              </div>
            </div>
            <div>
              <label className="block text-white mb-3 text-sm font-bold">
                Message
              </label>
              <textarea
                rows={6}
                className="w-full px-6 py-4 bg-white/10 border-2 border-white/30 rounded-2xl text-white placeholder-white/60 focus:outline-none focus:border-[#FFD6A9] focus:bg-white/20 transition-all resize-none backdrop-blur-md"
                placeholder="Tell me about your project or idea..."
              />
            </div>
            <motion.button
              whileHover={{
                scale: 1.02,
                boxShadow:
                  "0 25px 60px rgba(255, 214, 169, 0.5)",
              }}
              whileTap={{ scale: 0.98 }}
              type="submit"
              className="w-full px-8 py-5 bg-white text-[#A3554F] rounded-2xl font-bold text-lg hover:bg-[#FFD6A9] hover:text-[#6A8284] transition-all shadow-2xl"
            >
              Send Message
            </motion.button>
          </form>
        </motion.div>

        {/* Social Links */}
        <motion.div
          initial={{ opacity: 0, y: 30 }}
          animate={isInView ? { opacity: 1, y: 0 } : {}}
          transition={{ duration: 0.6, delay: 0.4 }}
          className="flex justify-center gap-6"
        >
          {[
            { icon: Github, href: "#", label: "GitHub" },
            { icon: Linkedin, href: "#", label: "LinkedIn" },
            { icon: Mail, href: "#", label: "Email" },
          ].map((social, index) => {
            const Icon = social.icon;
            return (
              <motion.a
                key={index}
                href={social.href}
                initial={{ opacity: 0, y: 20 }}
                animate={isInView ? { opacity: 1, y: 0 } : {}}
                transition={{ delay: 0.5 + index * 0.1 }}
                whileHover={{ scale: 1.2, y: -10 }}
                whileTap={{ scale: 0.95 }}
                className="relative group"
                aria-label={social.label}
              >
                {/* Glow */}
                <div className="absolute -inset-2 bg-white rounded-3xl opacity-0 group-hover:opacity-30 blur-xl transition-opacity" />

                {/* Button */}
                <div className="relative w-18 h-18 bg-white/10 backdrop-blur-xl rounded-2xl flex items-center justify-center text-white hover:bg-white hover:text-[#A3554F] transition-all shadow-xl border-2 border-white/30 p-5">
                  <Icon size={30} />
                </div>
              </motion.a>
            );
          })}
        </motion.div>
      </div>
    </section>
  );
}