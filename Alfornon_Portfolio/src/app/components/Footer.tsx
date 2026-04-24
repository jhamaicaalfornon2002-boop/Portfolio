import { motion } from 'motion/react';
import { Heart, ArrowUp } from 'lucide-react';

export function Footer({ scrollToSection }: { scrollToSection: (id: string) => void }) {
  const currentYear = new Date().getFullYear();

  const footerLinks = [
    {
      title: 'Navigation',
      links: [
        { label: 'Home', id: 'home' },
        { label: 'About', id: 'about' },
        { label: 'Works', id: 'works' },
        { label: 'Skills', id: 'skills' },
      ]
    },
    {
      title: 'More',
      links: [
        { label: 'Certificates', id: 'certificates' },
        { label: 'Contact', id: 'contact' },
      ]
    }
  ];

  return (
    <footer className="relative bg-gradient-to-br from-[#6A8284] to-[#9EB2B1] overflow-hidden">
      {/* Decorative Shapes */}
      <div className="absolute top-0 left-0 w-64 h-64 bg-[#A3554F]/10 rounded-full blur-3xl" />
      <div className="absolute bottom-0 right-0 w-80 h-80 bg-[#E4B192]/10 rounded-full blur-3xl" />

      <div className="relative z-10 max-w-7xl mx-auto px-6 py-16">
        {/* Main Footer Content */}
        <div className="grid md:grid-cols-4 gap-12 mb-12">
          {/* Brand Column */}
          <div className="md:col-span-2">
            <motion.div
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              className="flex items-center gap-2 mb-6"
            >
              <div className="w-12 h-12 bg-gradient-to-br from-[#A3554F] to-[#C1705A] rounded-xl flex items-center justify-center shadow-lg">
                <div className="text-white font-bold text-lg">JA</div>
              </div>
              <span className="text-2xl font-bold text-white">Jhamaica Alfornon</span>
            </motion.div>
            <motion.p
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ delay: 0.1 }}
              className="text-white/80 leading-relaxed mb-6 max-w-md"
            >
              IT Student & Creative Developer passionate about building innovative digital experiences
              with clean code and beautiful design.
            </motion.p>
            <motion.div
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ delay: 0.2 }}
              className="flex items-center gap-2 text-white/70"
            >
              <span>Made with</span>
              <Heart className="text-[#C1705A]" size={16} fill="#C1705A" />
              <span>using React & Tailwind</span>
            </motion.div>
          </div>

          {/* Links Columns */}
          {footerLinks.map((section, idx) => (
            <motion.div
              key={idx}
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ delay: 0.1 * (idx + 1) }}
            >
              <h4 className="text-white font-bold mb-4">{section.title}</h4>
              <ul className="space-y-3">
                {section.links.map((link, i) => (
                  <li key={i}>
                    <button
                      onClick={() => scrollToSection(link.id)}
                      className="text-white/70 hover:text-white transition-colors text-sm"
                    >
                      {link.label}
                    </button>
                  </li>
                ))}
              </ul>
            </motion.div>
          ))}
        </div>

        {/* Divider */}
        <div className="w-full h-px bg-white/20 mb-8" />

        {/* Bottom Bar */}
        <div className="flex flex-col md:flex-row items-center justify-between gap-4">
          <motion.p
            initial={{ opacity: 0 }}
            whileInView={{ opacity: 1 }}
            viewport={{ once: true }}
            className="text-white/70 text-sm"
          >
            © {currentYear} Jhamaica Alfornon. All rights reserved.
          </motion.p>

          {/* Back to Top Button */}
          <motion.button
            initial={{ opacity: 0 }}
            whileInView={{ opacity: 1 }}
            viewport={{ once: true }}
            whileHover={{ scale: 1.05, y: -3 }}
            whileTap={{ scale: 0.95 }}
            onClick={() => scrollToSection('home')}
            className="flex items-center gap-2 px-5 py-2.5 bg-white/10 backdrop-blur-md rounded-xl text-white hover:bg-white/20 transition-all border border-white/20"
          >
            <span className="text-sm font-medium">Back to Top</span>
            <ArrowUp size={16} />
          </motion.button>
        </div>
      </div>
    </footer>
  );
}
