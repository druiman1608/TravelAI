import React from "react";
import styles from "./MainLayout.module.css";

export default function MainLayout({
  sidebar,
  children,
  title,
  totalCount,
  unit = "resultados",
}) {
  return (
    <div className={styles.pageContainer}>
      <aside className={styles.sidebarSection}>{sidebar}</aside>
      <main className={styles.resultsSection}>
        <div className={styles.resultsHeader}>
          <h2>{title}</h2>
          <span className={styles.countTag}>
            {totalCount} {unit}
          </span>
        </div>

        <div className={styles.contentWrapper}>{children}</div>
      </main>
    </div>
  );
}
