import * as React from "react"
import { memo } from "react"

import { cn } from "@/lib/utils"

// Pre-computed base classes to avoid recalculating on every render
// Removed heavy transition-[color,box-shadow] which can cause input lag
const baseInputClasses = "border-input file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground flex h-9 w-full min-w-0 rounded-md border bg-transparent px-3 py-1 text-base shadow-xs outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
const focusClasses = "focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
const invalidClasses = "aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive"

const Input = memo(function Input({ className, type, ...props }: React.ComponentProps<"input">) {
  return (
    <input
      type={type}
      data-slot="input"
      className={cn(
        baseInputClasses,
        focusClasses,
        invalidClasses,
        className
      )}
      {...props}
    />
  )
})

export { Input }
